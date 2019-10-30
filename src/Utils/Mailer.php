<?php

namespace App\Utils;


use App\Entity\AdvertResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(\Swift_Mailer $mailer, ContainerInterface $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    public function sendAdvertResponseConfirmation(AdvertResponse $advertResponse)
    {
        $message = new \Swift_Message();
        $message
            ->setTo($advertResponse->getAdvert()->getEmail())
            ->setFrom("kurs@alx.yum.pl", "Portal ogłoszeń")
            ->setSubject("Kontakt w sprawie ogłoszenia {$advertResponse->getAdvert()->getTitle()}")
//            ->setBody("treść wiadomości")
        ;

        $htmlBody = $this
            ->container
            ->get("twig")
            ->render("emails/advert-reponse-confirmation.html.twig", [
                'advertResponse' => $advertResponse,
            ]);
        $message->setBody($htmlBody, 'text/html');
        $message->setReplyTo($advertResponse->getEmail());

        $this->mailer->send($message);
    }

}