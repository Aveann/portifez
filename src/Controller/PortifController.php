<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Filesystem\Filesystem;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Portif;

use App\Form\PortifAddForm;
use App\Form\PortifEditForm;

use App\Service\FileUploader;



class PortifController extends AbstractController
{
	
    /**
     * @Route("/portif/{id}", name="portif")
     */
    public function portif($id)
    {

			
		$repository = $this->getDoctrine()->getRepository(Portif::class);
		$portif = $repository->find($id);
		
		if (!$portif) {
			 return $this->render('portif/error.html.twig', [
				'block_title' => 'Ce portif n\'existe pas',
			 ]);
			 
		}
			
		$posts = $portif->getPosts();
		
        return $this->render('portif/portif.html.twig', [
			'portif' => $portif,
			'posts' => $posts,
			'block_title' => $portif->getName()
        ]);
    }   

	/**
     * @Route("/portif/{id}/about", name="portif_about")
     */
    public function portif_about($id)
    {

			
		$repository = $this->getDoctrine()->getRepository(Portif::class);
		$portif = $repository->find($id);
		
		if (!$portif) {
			 return $this->render('portif/error.html.twig', [
				'block_title' => 'Ce portif n\'existe pas',
			 ]);
			 
		}
		
        return $this->render('portif/page_about.html.twig', [
			'portif' => $portif,
			'block_title' => $portif->getName()
        ]);
    }
	

	
	/**
     * @Route("/user/portif/add", name="portif_add")
     */
	public function portif_add(Request $request)
    {
		$error = "";
		$success = "";
		
        $portif = new Portif();
        $form = $this->createForm(PortifAddForm::class, $portif, 
			['action' => $this->generateUrl('portif_add')]
		);

        $form->handleRequest($request);
		
        if ($form->isSubmitted() && $form->isValid()) {
			
			if($form['illustration_activated']->getData()){
				
				$portif->setIllustrationActivated(true);
				
				if($form['illustration']->getData() != ''){
					
					$fileUploader = new FileUploader($this->getParameter('illustration_directory'));
					
					$illustration = $form->get('illustration')->getData();
					$illustrationName = $fileUploader->upload($illustration);
					$portif->setIllustration($illustrationName);
				
				}
			
			} else {
				
				$portif->setIllustrationActivated(false);
			}
			
			$portif->setUser($this->getUser());

			
            $entityManager = $this->getDoctrine()->getManager();
				
			$success = "Portif correctement ajouté";
			
			$entityManager->persist($portif);
			$entityManager->flush();
			
        }
			
        return $this->render('portif/form_add.html.twig', [
			'block_title' => 'Ajouter un portif',
            'form' => $form->createView(),
			'error' => $error,
			'success' => $success
        ]);
    }
	
	/**
     * @Route("/portif/{id}/edit", name="portif_edit")
     */
	public function portif_edit(Request $request, $id)
    {
		$success = "";
		$error = "";
		
		$portif = $this->getDoctrine()
			->getRepository(Portif::class)
			->find($id);
			
		if (!$portif) {
			return $this->render('portif/portif.html.twig', [
				'block_title' => 'Ce portif n\'existe pas',
			]);
		} 
		
		//test si le portif appartient à l'user qui veut le modifier
		if($portif->getUser() != $this->getUser()){
			throw new AccessDeniedException('Unable to access this page!');
		} else {

		
			$illustrationName = $portif->getIllustration();
		
			$form = $this->createForm(
				PortifEditForm::class, 
				$portif
			);
				
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				
				if($form['illustration_activated']->getData()){
					
					$portif->setIllustrationActivated(true);
					
					if($form['illustration']->getData() != ''){
						
						$fileUploader = new FileUploader($this->getParameter('illustration_directory'));
						
						$illustration = $form->get('illustration')->getData();
						$illustrationName = $fileUploader->upload($illustration);
					
					}
					
					$portif->setIllustration($illustrationName);
				
				} else {
					
					$portif->setIllustrationActivated(false);
				}
				
				$success = "Le portif a correctement été mis à jour.";
				
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->flush();
			}
			
				
			return $this->render('portif/form_edit.html.twig', [
				'form' => $form->createView(),
				'success' => $success,
				'portif' => $portif, 
				'action' => $this->generateUrl('portif_edit', ['id' => $id]),
				'block_title' => 'Mettre à jour "'. $portif->getName() .'"',
			]);
		}
	}
	
	
	/**
     * @Route("/portif/{id}/delete", name="portif_delete")
	 */
	public function portif_delete($id){
		$portif = $this->getDoctrine()
		->getRepository(Portif::class)
		->find($id);
		
		//test si le portif appartient à l'user qui veut le modifier
		if($portif->getUser() != $this->getUser()){
			throw new AccessDeniedException('Unable to access this page!');
		} else {
			
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($portif);
			$entityManager->flush();
			
			return $this->redirect($this->generateUrl('user', ['id'=> $this->getUser()->getId()]));
		}
	}
}
