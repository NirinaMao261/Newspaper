<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private SluggerInterface $slugger;
    
    public function load(ObjectManager $manager): void 
    {
        $this->slugger = $slugger;
        // $product = new Product();
        // $manager->persist($product);
    }

    public function load(ObjectManager $manager): void 
    
    {
    $categories =[
        
        'Loisirs',
        'Société',
        'Jeu vidéo',
        'Ecologie',
        'Technologie',
        'Mode',
        'Politique',
        'Sport',

];

foreach($categories as $name) {

    $category = new Category();

    $category->setName($name);
    $category->setAlias($this->slugger->slug($name));

    $category->setCreatedAt(new DateTime());
    $category->setUpdatedAt(new DateTime());

    $manager->persist($category);
}

        # La méthode flush() n'est pas dans la boucle foreach() pour une raison :
        # => cette méthode "vide" l'objet $manager qui est un 'container'.
        # Avant de se 'vider', le $manager exécute les insertions en BDD, pour de vrai cette fois ci !
        $manager->flush();
    }
}
