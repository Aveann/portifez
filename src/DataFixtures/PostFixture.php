<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Portif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
		/*$portif = new Portif();
		
		$portif
			->setName('Ecole poids verts')
			->setAbout('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue blandit fringilla. Duis in ligula id est interdum imperdiet ut eget diam. Donec bibendum eros ligula, id finibus lorem malesuada ut. Fusce leo magna, feugiat eget ipsum non, blandit faucibus eros. Vestibulum quis ipsum quis tortor blandit porta. Maecenas aliquam fermentum pretium. Mauris pellentesque odio est, placerat rhoncus nulla tristique vitae. Integer porttitor erat consequat, consequat elit vitae, gravida est. Mauris condimentum nibh mauris, ut rutrum mauris mollis ut. Nulla cursus quam id metus fringilla venenatis. Proin ornare arcu at turpis sollicitudin ultrices eu eu libero. Sed scelerisque nec dui a tempor.')
			->setUsername('username')
			->setPassword('password');
			
		
        $manager->persist($portif);
		
        $post = new Post();
		
		//$date = new DateTime(date("Y-m-d"));
		$post
			->setTitle('La collecte des pommes')
			->setContent('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
			->setPortif(1);
			
		
        $manager->persist($post);

        $manager->flush();*/
    }
}
