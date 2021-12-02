<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\ContatTypeorig;
use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact2", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer):Response
    {

        $form=$this->createForm(ContatTypeorig::class);
        $form->handleRequest($request);
        if($form -> isSubmitted()&& $form ->isValid()){
            $contact=$form->getData();
            $message=(new \Swift_Message('Nouveau Msg'))
                ->setFrom($contact['test'])
                ->setTo('inovvat@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',compact('contact')

                    ),
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('message',
                'le message est envoyé');
            return $this ->redirectToRoute('form_new');

        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);

    }
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function email(Request $request , Swift_Mailer $mailer)
    {

        $contact= new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        # check if form is submitted

        if($form->isSubmitted() &&  $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $message = $form['message']->getData();

            # set form data

            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setMessage($message);

            # finally add data in database

            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();
            $subj = (new \Swift_Message('Proposition'))
                ->setFrom($email)
                ->setTo('mohamedhabib.khattat@esprit.tn')
                ->setBody($this->renderView('emailTemplate/sendEmail.html.twig',array('name' => $name, 'message' => $message)),'text/html');
            $mailer->send($subj);

        }

        return $this->render('emailTemplate/contact.html.twig',['emailForm' => $form->createView()]);
    }
}
