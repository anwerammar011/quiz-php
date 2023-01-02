<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\User;
use App\Entity\QuizQuestionsOptions;
use App\Form\QuizFormType;
use App\Form\QuestionFormType;
use App\Entity\Questions;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Form;
use Doctrine\Common\Collections\ArrayCollection;


class OtherServicesController extends AbstractController
{


   /**
     * @Route("/quiz", name="quiz")
     */
    public function addQuiz(Request $request): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizFormType::class,$quiz);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('quizList');
        } 
        return $this->render('quiz/quiz.html.twig',
         [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/questions/{id}", name="questions")
     */
    public function addQuestions(Request $request,int $id): Response

    {
        $Repository = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $Repository->find($id);
        // creates a Question object with options and initializes some data for this example
        $questionform = new Questions();
        

         $form = $this->createForm(QuestionFormType::class,$questionform);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()){
             $em=$this->getDoctrine()->getManager();

            $question=$form->getData();
            $option1 = new QuizQuestionsOptions();
            $option1->setOptionText($form->get("champs1")->getData());

            $option2 = new QuizQuestionsOptions();
            $option2->setOptionText($form->get("champs2")->getData());


            $option3 = new QuizQuestionsOptions();
            $option3->setOptionText($form->get("champs3")->getData());


            $option4 = new QuizQuestionsOptions();
            $option4->setOptionText($form->get("champs4")->getData());

            $question->addQuestionOption($option1);
            $question->addQuestionOption($option2);
            $question->addQuestionOption($option3);
            $question->addQuestionOption($option4);
            $question->setQuizId($id);
            $question->setQuiz($quiz);
            $question->setCorrection($option1);

            $question->setColorText($form->get("color_theme")->getData()->getColorText());

            $em->persist($question);
            $option1->addQuestion($question);
            $em->persist($option1);
            $option2->addQuestion($question);

            $em->persist($option2);
            $option3->addQuestion($question);

            $em->persist($option3);
            $option4->addQuestion($question);
            $em->persist($option4);
         $correction=$form->get('correction')->getData();
         switch ($correction) {
            case '1':
                $question->setCorrection($option1);
                
                break;
            case '2':
                $question->setCorrection($option2);
                
                break;    

            case '3':
                $question->setCorrection($option3);
                    
                break;   
                
            case '4':
                $question->setCorrection($option4);
                    
                break;     
            }
        
        
        $em->flush();
         }

         return $this->render('admin/questions.html.twig',
         [
           "form" => $form->createView(),
            
         ]);      
    }

    /**
     * @Route("/deleteQuestion/{id}/{currentQuestion}", name="deleteQuestion")
     */
    public function DeleteQuestions( int $currentQuestion,int $id)
    {   
        $Repository = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $Repository->find($id);
        $questionsArray =$quiz->getQuestions()->toArray(); 
        $em=$this->getDoctrine()->getManager();
        $em->remove($questionsArray[$currentQuestion - 1]);
        $em->flush(); 
        return $this->redirectToRoute('app_answers',["id" =>$id]);    
    }

        /**
     * @Route("/deleteQuiz/{id}", name="deleteQuiz")
     */
    public function DeleteQuiz( int $id)

    {   $Repository = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $Repository->find($id);     
        $em=$this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();
        
            return $this->redirectToRoute('quizList');    }
     

}
