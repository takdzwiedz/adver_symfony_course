<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function index(Connection $connection)
    {

        $em = $this->getDoctrine()->getManager();
        $em = $this->container->get('doctrine')->getManager();

        // 1 - metody magiczne
        // findAll() - wszystkie
        // find(id) - encja o konkretnym ID

        $categories = $em->getRepository(Category::class)->findAll();

        $categories = $em->getRepository(Category::class)->findBy([], ['name' => 'asc']);


        // 2 DQL Doctrine Querry Language
        $categories = $em->createQuery("
            SELECT category
            FROM App:Category category
            ORDER BY category.name DESC
        ")->getResult();

        // 3 Querry Builder
        $categories = $em->getRepository(Category::class)
            ->createQueryBuilder("category")
            ->orderBy('category.name', 'ASC')
            ->getQuery()
            ->getResult();

        // 4 Repository Method

        // 5 Tradycyjny

        $categories = $connection->query("Select * from category")
            ->fetchAll();

        dump($categories);

        return $this->render('default/index.html.twig', [
            'categories' => $categories
        ]);
    }
}
