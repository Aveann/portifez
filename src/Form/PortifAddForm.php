<?php

namespace App\Form;

use App\Entity\Portif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PortifAddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
				['label' => 'Nom']
			)
			->add('about', TextareaType::class, array(
				'required' => false,
				'label' => 'Description du site',
				'attr' => array('maxlength' => 255, 'rows' => '9')
			))
			->add('illustration_activated', ChoiceType::class, array(
				'choices' => array(
					'Oui' => true,
					'Non' => false,
				),
				'data' => true,
				'expanded' => true,
				'label' => 'Autoriser l\'illustration',
				'help' => 'Ceci pourra être modifié plus tard dans les paramètres',
			))
			->add('illustration', FileType::class, array(
				'required' => false,
				'label' => 'Image du thème'
			))
			->add('submit', SubmitType::class,
				['label' => 'Créer le portif']
			);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'	=> Portif::class,
        ));
    }
}