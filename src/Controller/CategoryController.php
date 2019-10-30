<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/kategoria/{slug}", name="category_show")
     * @Route("/kategoria/{slug}/{page}", name="category_show-page")
     */
    public function show($slug,
                         Category $category,
                         PaginatorInterface $paginator,
                         Request $request
    )
    {
        /*
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)
            ->findOneBy(['slug' => $slug]);

        // findOneByDOWOLNEPOLEZENCJI
        // findByDOWOLNEPOLEZENCJI
        $category =  $em->getRepository(Category::class)
            ->findOneBySlug($slug);

        $category = $em->createQuery("
            SELECT category
            FROM App:Category category
            WHERE category.slug = :slug
        ")
            ->setParameter('slug', $slug)
            ->getSingleResult();

        $category = $em->getRepository(Category::class)
            ->createQueryBuilder('category')
            ->where('category.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getSingleResult();
        */

        dump($category);

        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository(Advert::class)
            ->createQueryBuilder("advert")
            ->join("advert.categories", "category")
            ->where("category.slug = :slug")
            ->andWhere("advert.expiresAt > :data")
            ->andWhere("advert.status = :status")
            ->orderBy("advert.createdAt", "DESC")
            ->setParameters([
                "slug" => $slug,
                "data" => new \DateTime(),
                "status" => 20
            ])
//            ->setParameter("slug", $slug)
//            ->setParameter("data", new \DateTime())
//            ->setParameter("status", 20) // to 20 można przenieść do stałej w encji
//
            ->getQuery();
//            ->getResult();


        $pagination = $paginator->paginate(
            $adverts, /* query NOT result */
            $request->get('page', 1), /*page number*/
            10 /*limit per page*/
        );
        $pagination->setUsedRoute("category_show-page");


        dump($adverts);

//        foreach ($category->getAdverts() as $advert) {
//            dump($advert->getId());
//        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
//            'adverts' => $adverts,
            'pagination' => $pagination,
        ]);
    }
}
