<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("ładne Rowery");
        $category->setDescription("Piękne błyszczące samojeżdżace rowery");


        $advert = new Advert();
        $advert->setTitle("Rower Damka")
            ->setDescription("Ekstra Rower Artura")
            ->setFirstName("Artur")
            ->setLastName("Kacprzak")
            ->setEmail("art.kacprza@gmail.com")
            ->setPhone("694473288")
            ->setStatus(20)
            ->setExpiresAt(new \DateTime("+30days"))
            ->addCategory($category);

        // nie powoduje uruchomienia zapytań do bazy
        $manager->persist($category);
        $manager->persist($advert);

        // wysłanie zapytań do bazy
        $manager->flush();
    }
}
