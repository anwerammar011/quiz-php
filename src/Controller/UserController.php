<?php

namespace App\Controller;
namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Answers;
use App\Entity\User;
use App\Entity\QuizQuestionsOptions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Form;

class UserController extends AbstractController
{
    /**
    * @Route("/quizToAnswer", name="quizToAnswer")
    */
    public function quizToAnswer(){
        $Repository = $this->getDoctrine()->getRepository(Quiz::class);
        $Quiz = $Repository->findAll();    
        return $this->render('answers/quizToAnswer.html.twig',array('quizs'=> $Quiz) );
    }


    /**
     * @Route("/answer/{id}", name="app_answers")
     */
    public function answer(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $Repository = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $Repository->find($id);
        $answer = new Answers();

        $answerRepository = $this->getDoctrine()->getRepository(Answers::class);
        $answer = $answerRepository->UserAnswer($this->getUser()->getId(), $id);
       
        $cpt = 0;
        $formBuilder = $this->createFormBuilder([], ["allow_extra_fields" => true]);
       
        foreach ($quiz->getQuestions() as $question) {
            $cpt = $cpt + 1;
            $choice = [];
            foreach ($question->getQuestionOption() as $value) {
                $choice[$value->getOptionText()] = $value->getId();
            }
            $formBuilder->add('QuestionNumero' . $cpt, ChoiceType::class, [
                "row_attr"=>[
                    "id" => "question". $cpt,
                    "class" => "questionContainer"
                ],
                'choices'  =>  $choice,
                'expanded' => true,
                'label' =>
                "Question Numéro  " . $cpt . " : " . $question->getQuestionTexte()
            ]);
        }
        $formBuilder->add('Envoyer', SubmitType::class, []);
        $form = $formBuilder->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            foreach ( $form->getData() as $key=>$value){
                $submitAnswer= new Answers();
                $currentUser =  $this->getUser()->getId();
                $submitAnswer->setUserId($currentUser);
                $submitAnswer->setQuestionId($quiz->getId());
                $submitAnswer->setOptionId($value);
                $entityManager->persist($submitAnswer);
            }
        $entityManager->flush();
    }
        return $this->render('answers/answer.html.twig', [
            "form" => $form->createView(),
            "id" => $id,
            "theme" => $quiz->getQuizTheme()
        ]);

    }   
}
