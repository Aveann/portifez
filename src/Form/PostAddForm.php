<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostAddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
				['label' => 'Titre']
			)
			->add('content', TextareaType::class, array(
				'required' => false,
				'label' => 'Contenu'
			))
			->add('img', FileType::class, array(
				'required' => false,
				'label' => 'Image du post'
			))
			->add('submit', SubmitType::class,
				['label' => 'Ajouter le post']
			);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'	=> Post::class,
        ));
    }
}