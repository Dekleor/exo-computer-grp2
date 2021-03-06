<?php

namespace App\Form;

use App\Entity\Computers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComputerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Computers::AVAILABLE_TYPES),
            ]);


        public
        function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Computers::class,
            ]);
        }
    }
}
