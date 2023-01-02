<?php

namespace App\Form;

use App\Entity\Questions;
use App\Entity\Color;
;

use App\Entity\QuizQuestionsOptions;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('color_theme',EntityType::class,[
                
            "class" => Color::class,
            'choice_label' => "colorText" ,
            "mapped"=>false
 
    ])
            ->add('questionTexte',TextType::class,[
                "attr" => [
                    "class" =>"form-control"
                    
                ]
            ])

            
            
            ->add('champs1',TextType::class,[
                "attr" => [
                    "class" =>"form-control"
                    
                ],
                "mapped"=>false

            ])

            ->add('champs2',TextType::class,[
                "attr" => [
                    "class" =>"form-control"
                    
                ],
                "mapped"=>false

            ])

            ->add('champs3',TextType::class,[
                "attr" => [
                    "class" =>"form-control"
                    
                ],
                "mapped"=>false

            ])
            ->add('champs4',TextType::class,[
                "attr" => [
                    "class" =>"form-control"
                    
                ],
                "mapped"=>false

            ])
                 
            ->add('correction',ChoiceType::class,[
                "choices" => [
                     'option1'=>1,
                     'option2'=>2,
                     'option3'=>3,
                     'option4'=>4,
                    ],

            
                    
                 "mapped"=>false
    
             ]) ;      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
