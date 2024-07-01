<?php

namespace App\Form;

use App\Entity\Branche;
use App\Entity\Course;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('learning_path', ChoiceType::class, [
                'choices' => [
                    'bol' => 'bol',
                    'bbl' => 'bbl',
                    'bbl & bol' => 'bbl & bol',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    'mbo-niveau 1: entreeopleiding voor eenvoudig uitvoerend werk' => '1',
                    'mbo-niveau 2: basisberoepsopleiding voor uitvoerend praktisch werk' => '2',
                    'mbo-niveau 3: vakopleiding tot zelfstandig beroepsbeoefenaar' => '3',
                    'mbo-niveau 4: middenkaderopleiding en specialistenopleiding die recht geeft op doorstroom naar het hbo en zorgt voor brede inzetbaarheid en/of specialisatie' => '4',

                ],
            ])
            ->add('durence', ChoiceType::class, [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',


                ]
            ])
            ->add('start', ChoiceType::class, [
                'choices' => [
                    'januari' => 'januari',
                    'februari' => 'februari',
                    'maart' => 'maart',
                    'april' => 'april',
                    'mei' => 'mei',
                    'juni' => 'juni',
                    'juli' => 'juli',
                    'augustus' => 'augustus',
                    'september' => 'september',
                    'oktober' => 'oktober',
                    'november' => 'november',
                    'december' => 'december',
                ],
            ])
            ->add('img', FileType::class, [
                'mapped'=> false,
            ])
            ->add('branch', EntityType::class,[
                'class'=>Branche::class,
                'choice_label'=>'name'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
