<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\AdvertResponse;
use App\Form\AdvertResponseType;
use App\Utils\Mailer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class AdvertController extends AbstractController
{
    /**
     * @Route("/ogloszenie/{slug}", name="advert_show")
     */
    public function show(Advert $advert, Request $request, ObjectManager $em, Mailer $mailer)
    {
        if ($advert->getStatus() != Advert::STATUS_PUBLISHED
            || $advert->getExpiresAt() < new \DateTime()
        ) {
            throw new NotFoundHttpException();
        }

        $advertResponse = new AdvertResponse();
        $form = $this->createForm(AdvertResponseType::class, $advertResponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advertResponse->setIp($request->getClientIp());
            $advertResponse->setAdvert($advert);

            $em->persist($advertResponse);
            $em->flush();

            $mailer->sendAdvertResponseConfirmation($advertResponse);

            return $this->redirectToRoute('advert_show', ['slug' => $advert->getSlug()]);
        }


        return $this->render('advert/show.html.twig', [
            'advert' => $advert,
            'form'=>$form->createView(),
        ]);
    }
}