<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\Question;
use App\Entity\Radiooption;
use App\Entity\Reponse;
use App\Entity\Reponsequestion;
use App\Entity\Responseform;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;


class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(): Response
    {
        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    #[Route('/form/add', name: 'add_form', methods: ['GET', 'POST'])]
    public function addForm(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $data = json_decode($request->getContent(), true);

        $form = new Form();
        $form->setTitle($data['title']);
        $form->setDescription($data['description']);

        foreach ($data['questions'] as $questionData) {
            $question = new Question();
            $question->setQuestionText($questionData['questionText']);
            $question->setType($questionData['type']);
            $question->setIdForm($form);

            if (isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionData) {
                    $option = new Radiooption();
                    $option->setOptionText($optionData['optionText']);
                    $option->setIdQuestion($question);
                    $question->addRadiooption($option);
                }
            }

            $form->addQuestion($question);
        }

        $entityManager->persist($form);
        $entityManager->flush();

        return new Response('Form added successfully', Response::HTTP_CREATED);
    }

    #[Route('/form/all', name: 'get_all_forms', methods: ['GET'])]
    public function getAllForms(EntityManagerInterface $entityManager): Response
    {
        $formRepository = $entityManager->getRepository(Form::class);
        $forms = $formRepository->findAll();

        $data = [];
        foreach ($forms as $form) {
            $data[] = [
                'title' => $form->getTitle(),
                'description' => $form->getDescription(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/form/{id}', name: 'get_form', methods: ['GET'])]
    public function getForm(int $id, EntityManagerInterface $entityManager): Response
    {
        $formRepository = $entityManager->getRepository(Form::class);
        $form = $formRepository->find($id);

        if (!$form) {
            return $this->json(['error' => 'Form not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'title' => $form->getTitle(),
            'description' => $form->getDescription(),
            'questions' => []
        ];

        foreach ($form->getQuestions() as $question) {
            $questionData = [
                'id' => $question->getId(),
                'questionText' => $question->getQuestionText(),
                'type' => $question->getType(),
            ];

            if ($question->getType() == 'radio') {
                $questionData['options'] = [];
                foreach ($question->getRadiooptions() as $option) {
                    $questionData['options'][] = [
                        'id' => $option->getId(),
                        'optionText' => $option->getOptionText()
                    ];
                }
            }

            $data['questions'][] = $questionData;
        }

        return $this->json($data);
    }


    #[Route('/api/addres', name: 'submit_form_responses', methods: ['GET', 'POST'])]
    public function submitFormResponses(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $formId = $data['formId'];
        $responses = $data['responses'];
        $currentDateTime = new \DateTime();

        // Create and persist the Reponse entity
        $reponse = new Reponse();
        $reponse->setIdForm($entityManager->getRepository(Form::class)->find($formId));
        $reponse->setDateResponse($currentDateTime);

        $entityManager->persist($reponse);
        $entityManager->flush();

        // Get the ID of the persisted Reponse entity
        $reponseId = $reponse->getId();

        // Iterate over the responses and create Reponsequestion entities
        foreach ($responses as $questionId => $reponseText) {
            $reponseQuestion = new Reponsequestion();
            $reponseQuestion->setIdQuestion($entityManager->getRepository(Question::class)->find($questionId));
            $reponseQuestion->setIdReponse($reponse);
            $reponseQuestion->setReponseText($reponseText);

            $entityManager->persist($reponseQuestion);
        }

        $entityManager->flush();

        return new Response('Responses submitted successfully', Response::HTTP_CREATED);
    }


}
