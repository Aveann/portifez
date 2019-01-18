<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


use App\Entity\Post;
use App\Entity\Portif;
use App\Entity\User;

use App\Form\PostAddForm;
use App\Form\PostEditForm;

use App\Service\FileUploader;

/**
* Consulter la liste de posts d'un portif
*/
class PostController extends AbstractController
{
	/**
     * @Route("/portif/{portif_id}/post/{id}", name="post")
     */
    public function post(Request $request, $portif_id, $id)
    {
		$post = $this->getDoctrine()
				->getRepository(Post::class)
				->find($id);
				
		$portif = $this->getDoctrine()
			->getRepository(Portif::class)
			->find($portif_id);
		
		$user = $this->getDoctrine()
			->getRepository(User::class)
			->find($portif->getUser());
			//var_dump($portif->getUser()->getId());
			
        return $this->render('post/post.html', [
			'block_title'	=> $post->getTitle(),
			'portif'		=> $portif,
			'post'			=> $post,
			'user'			=> $user,
			
        ]);
    } 
	
    /**
     * @Route("/portif/{portif_id}/post/list", name="post_list")
     */
    public function post_list($portif_id)
    {
        return $this->render('post/index.html.twig', [
			'block_title' => 'Ajouter un portif',
        ]);
    }      
	
   
	
	/**
	 * Ajoute un post dans le portif.
	 *
     * @Route("/portif/{portif_id}/add", name="post_add")
     */
    public function post_add(Request $request, $portif_id)
    {
		$error = "";
		$success = "";
		
		$portif = $this->getDoctrine()
			->getRepository(Portif::class)
			->find($portif_id);
		
		//test si le portif appartient à l'user qui veut le modifier
		if($portif->getUser() != $this->getUser()){
			throw new AccessDeniedException('Unable to access this page!');
		} else {
			$post = new Post();
			$form = $this->createForm(PostAddForm::class, $post, 
				['action' => $this->generateUrl('post_add', ['portif_id' => $portif_id])]
			); 
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				
				if($form['img']->getData() != ''){
					
					$fileUploader = new FileUploader($this->getParameter('img_directory'));
					
					$img = $form->get('img')->getData();
					$imgName = $fileUploader->upload($img);
					
					$post->setImg($imgName);
				}
				
				$post->setPortif($portif);
				
				$entityManager = $this->getDoctrine()->getManager();
					
				$success = "Post ajouté avec succés";
				
				$entityManager->persist($post);
				$entityManager->flush();
				
			}
				
			return $this->render('post/form_add.html.twig', [
				'block_title' => 'Ajouter un portif',
				'form' => $form->createView(),
				'success' => $success,
				'error' => $error,
				'portif' => $portif
			]);
		}
    }    
	
	/**
     * @Route("/portif/{portif_id}/post/{id}/edit", name="post_edit")
     */
    public function post_edit(Request $request, $portif_id, $id)
    {
		$error = "";
		$success = "";
		
		$portif = $this->getDoctrine()
			->getRepository(Portif::class)
			->find($portif_id);
		
		//test si le portif appartient à l'user qui veut le modifier
		if($portif->getUser() != $this->getUser()){
			throw new AccessDeniedException('Unable to access this page!');
		} else {
			$post = $this->getDoctrine()
				->getRepository(Post::class)
				->find($id);
			
			$form = $this->createForm(PostEditForm::class, $post, 
				['action' => $this->generateUrl('post_edit', ['portif_id' => $portif_id, 'id' => $id])]
			); 
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				
				if($form['img']->getData() != ''){
					
					$fileUploader = new FileUploader($this->getParameter('img_directory'));
					
					$img = $form->get('img')->getData();
					$imgName = $fileUploader->upload($img);
					
					$post->setImg($imgName);
				}
				
				$entityManager = $this->getDoctrine()->getManager();
					
				$success = "Post modifié avec succés";
				
				$entityManager->flush();
				
			}
				
			return $this->render('post/form_edit.html.twig', [
				'block_title' => 'Modifier' . $post->getTitle(),
				'form' => $form->createView(),
				'success' => $success,
				'error' => $error,
				'portif' => $portif
			]);
		}
    }
}
