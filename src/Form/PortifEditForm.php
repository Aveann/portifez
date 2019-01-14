<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Portif;

class PortifEditForm extends AbstractType
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
				'attr' => array('maxlength' => 500, 'rows' => '9')
			))
			->add('illustration', FileType::class, array(
				'required' => false,
				'label' => 'Image du thème',
				'data_class'=> null
			))
			->add('illustration_activated', ChoiceType::class, array(
				'choices' => array(
					'Oui' => true,
					'Non' => false,
				),
				'expanded' => true,
				'label' => 'Activer l\'illustration du blog',
				
			))
			->add('submit', SubmitType::class,
				['label' => 'Enregistrer les modifications']
			);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'	=> Portif::class,
			'validation_groups' => array('edit')
        ));
    }
}