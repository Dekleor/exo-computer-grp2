<?php

namespace App\Form;

use App\Entity\Component;
use DateTime;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'maxlength' => 128,
                ],
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'EUR',
                'divisor' => 100,
            ])
            ->add('brand', TextType::class)
            ->add('description', TextareaType::class)
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Component::AVAILABLE_TYPES),
                'multiple' => false,
                'expanded' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Component::class,
        ]);
    }
}
