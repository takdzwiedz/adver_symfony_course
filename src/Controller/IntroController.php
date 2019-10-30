<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IntroController extends AbstractController
{
    /**
     * @Route("/intro/{page<\d+>?100}.{_format}",
     *     defaults={"_format" = "html"},
     *     methods={"GET"},
     *     name="intro_index")
     */
    public function index(Request $request, $page, $_format)
    {

        if ('json' == $_format) {
            return new JsonResponse([
                'page' => $page
            ]);
        }

        $viewParams = [
            'page' => $page,
            'name' => 'Artur',
            'tablica' => [10,20,30,40,50,60],
            'tablica2' => [],
            'komentarz' => "Ala ma <b>" . $page . "</b> kotów.",

        ];

        return $this->render('intro/index.html.twig', $viewParams);
//        return new Response("Ala ma " . $page . " kotów.");
    }

    /**
     * @Route("/firewall-test", name="intro_firewall-test")
     * @IsGranted("ROLE_ADMIN")
     */
    public function firewallTest()
    {
//        $this->denyAccessUnlessGranted("ROLE_SUPER_ADMIN");

        return $this->render("intro/firewall-test.html.twig");
    }
}
