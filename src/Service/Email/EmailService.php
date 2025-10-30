<?php

namespace App\Service\Email;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class EmailService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendArticleNotification(): void
    {
        $email = (new TemplatedEmail())
            ->from('noreply@example.com')
            ->to('gpelloin@gmail.com')
            ->subject('Article enregistré avec succès')
            ->htmlTemplate('emails/test.html.twig')
            ->context([
                'username' => 'Didier Deschamps'
            ]);

        $this->mailer->send($email);
    }
}