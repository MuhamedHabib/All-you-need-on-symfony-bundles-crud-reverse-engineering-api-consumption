<?php

namespace App\Form;

use App\Entity\Questionss;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuestionssType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Question1', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question2', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question3', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question4', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question5', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question6', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
            ->add('Question7', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                    'Je ne sais pas'=>'Je ne sais pas'
                ],'expanded'=> true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionss::class,
        ]);
    }
}
