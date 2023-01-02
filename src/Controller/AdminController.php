<?php

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


class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin")
    */
    public function admin()
    {
    return $this->render('admin/admin.html.twig');
    }


     /**
    * @Route("/choiceQuizOrder", name="choiceQuizOrder")
    */
    public function choiceQuizOrder()
    
    {
     $Repository = $this->getDoctrine()->getRepository(Quiz::class);
     $Quiz = $Repository->findAll();
         
    return $this->render('answers/choiceQuizOrder.html.twig',array('quizs'=> $Quiz) );
    }
     /**
    * @Route("/quizList", name="quizList")
    */
    public function quizList()
    
    {
     $Repository = $this->getDoctrine()->getRepository(Quiz::class);
     $Quiz = $Repository->findAll();
         
    return $this->render('admin/quizList.html.twig',array('quizs'=> $Quiz) );
    }


    /**
    * @Route("/order/{id}", name="order")
    */
    public function userOrder(Request $request, EntityManagerInterface $entityManager,$id):Response
    {
    $answerRepository = $this->getDoctrine()->getRepository(Answers::class);
     $order = $answerRepository->userOrderByAnswer($id);

    ;

        return $this->render('answers/Order.html.twig',["order" =>$order,]);
    } 
}
