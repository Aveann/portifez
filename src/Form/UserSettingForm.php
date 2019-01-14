<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserSettingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('avatar', FileType::class, array(
				'required' => false,
				'data_class'=> null,
				'label' => false
			))
		    ->add('nickname', TextType::class, array(
				'label' => false
			))
			->add('bio', TextareaType::class, array(
				'required' => false,
				'label' => false,
				'attr' => array('maxlength' => 255, 'rows' => '9')
			))
            ->add('firstname', TextType::class, array(
				'required' => false,
				'label' => 'Prénom'
			))
			->add('lastname', TextType::class, array(
				'required' => false,
				'label' => 'Nom'
			))
			->add('birthday', DateType::class, array(
				'widget' => 'choice',
				'input' => 'string',
				'years' => range(date('Y'), date('Y') - 125),
				'label' => 'Date de naissance'
			))
			->add('submit', SubmitType::class, ['label'=>'Confirmer']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
			'validation_groups' => array('edit')
        ));
    }
}