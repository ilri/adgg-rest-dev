<?php

namespace App\Controller;

use App\Repository\MilkYieldRecordDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    private $repository;

    public function __construct(MilkYieldRecordDataRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/email")
     * @param MailerInterface $mailer
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $milkyield = $this->repository->getMilkYieldRecord(704911);
        dump($milkyield);
        exit();
        $email = (new Email())
            ->from('ADGGILRIsupport@cgiar.org')
            ->to('d.mogaka@cgiar.org')
            ->cc('cezar.pendarovski@roslin.ed.ac.uk')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        return new Response('Email sent!');
    }
}