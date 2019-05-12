<?php

namespace App\Controller;

use App\Entity\ContactUs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    /**
     * @var string
     */
    private $mailerFrom;

    /**
     * ContactUsController constructor.
     * @param string $mailerFrom
     */
    public function __construct(string $mailerFrom)
    {
        $this->mailerFrom = $mailerFrom;
    }

    /**
     * @Route("/contact/sendEmail", methods={"POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Exception
     */
    public function sendEmail(Request $request, \Swift_Mailer $mailer): Response
    {
        if (!$request->isXmlHttpRequest()) {
            $response = new Response();
            $response->setStatusCode(500);
            return $response;
        }

        $emailData = $request->request->get('contact_us');

        // Save in DB
        $em = $this->getDoctrine()->getManager();
        $contactUs = new ContactUs();
        $contactUs->setEmail($emailData['email']);
        $contactUs->setMessage($emailData['message']);
        $contactUs->setDate(new \DateTime('now'));

        $em->persist($contactUs);
        $em->flush();

        // Send Email
        // Prepare message email
        $messageUser = "<p>Hello, someone sent you an email.</p>"
            . "<p>Email : " . $emailData['email'] . "</p>"
            . "<p>Message :<br/>" . nl2br($emailData['message']) . "</p>";

        $message = (new \Swift_Message('A new message from wild circus website'))
            ->setFrom([$this->mailerFrom => "Wild Circus"])
            ->setTo($this->mailerFrom)
            ->setBody($messageUser, 'text/html');

        $mailer->send($message);

        return $this->json('send');
    }
}
