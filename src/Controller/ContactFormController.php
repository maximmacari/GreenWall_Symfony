<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use App\Repository\ContactFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactFormController extends AbstractController
{
    #[Route('/', name: 'contact_form_index', methods: ['GET'])]
    public function index(ContactFormRepository $contactFormRepository): Response
    {
        return $this->render('contact_form/index.html.twig', [
            'contact_forms' => $contactFormRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'contact_form_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $contactForm = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contactForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            try{
                $entityManager->persist($contactForm);
                $entityManager->flush();

                $this->addFlash('success', 'Form has been sent!');
                return $this->redirectToRoute('contact_form_new', [], Response::HTTP_SEE_OTHER);
            }
            catch(\Exception $e){
                $this->addFlash('failure', $e->getMessage());
            }
        }

        return $this->renderForm('contact_form/new.html.twig', [
            'contact_form' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'contact_form_show', methods: ['GET'])]
    public function show(ContactForm $contactForm): Response
    {
        return $this->render('contact_form/show.html.twig', [
            'contact_form' => $contactForm,
        ]);
    }

    #[Route('/{id}/edit', name: 'contact_form_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactForm $contactForm): Response
    {
        $form = $this->createForm(ContactFormType::class, $contactForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_form/edit.html.twig', [
            'contact_form' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'contact_form_delete', methods: ['POST'])]
    public function delete(Request $request, ContactForm $contactForm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactForm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
