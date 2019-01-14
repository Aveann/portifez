<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('nickname', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Répéter mot de passe'),
            )
			)
			->add('firstname', TextType::class, array(
				'required' => false
			))
			->add('lastname', TextType::class, array(
				'required' => false
			))
			->add('birthday', DateType::class, array(

				'widget' => 'choice',
				'input' => 'string',
				'years' => range(date('Y'), date('Y') - 125)
			))
			->add('bio', TextType::class, array(
				'required' => false
			))
			->add('avatar', FileType::class, array(
				'required' => false
			))
			->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
				'constraints' => new IsTrue(),
            ))
			->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'	=> User::class,
        ));
    }
}