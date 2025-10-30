<?php
namespace App\Service\Form;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;
use App\Service\Email\EmailService;

class FormHandler
{
    private Request $request;
    private FlashBagInterface $flash;
    private EmailService $emailService;
    

    public function __construct(
        private EntityManagerInterface $em,
        private FormFactoryInterface $form,
        RequestStack $requestStack,
        private Environment $twig,
        EmailService $emailService
        )
    {
        $this->flash = $requestStack->getSession()->getFlashBag();
        $this->request = $requestStack->getCurrentRequest();
        $this->emailService = $emailService;
    }
/**
 * Méthode qui permet de gérer n'importe quel formulaire 
 * @param string $formType
 * @param string $redirectLink
 * @param string $templatePath
 * @param ?object $entity = null 
 * @return Response|RedirectResponse
 */

    public function handle(string $formType, string $redirectlink, string $templatePath, ?object $entity = null): Response|RedirectResponse
    {
        $form = $this->form->create($formType, $entity);
        $form->add('submit', SubmitType::class);

        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->em->persist($data);
            $this->em->flush();

            $this->emailService->sendArticleNotification();

            if(!$entity){
                $this->flash->add('success', 'Article enregistré avec succès !');
            } else {
                $this->flash->add('success', 'Votre article a bien été modifié');
            }

            return new RedirectResponse($redirectlink);
        }

         return new Response($this->twig->render($templatePath, [
            'entity'=> $entity,
            'form' => $form->createView(),

        ]));
    }
}