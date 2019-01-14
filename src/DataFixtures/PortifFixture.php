<?php

namespace App\DataFixtures;

use App\Entity\Portif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PortifFixture extends Fixture
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

        $manager->flush();
		*/
    }
}
