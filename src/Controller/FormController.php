<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\Question;
use App\Entity\Radiooption;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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

            if ($question->getType() !== 'input') {
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
}
