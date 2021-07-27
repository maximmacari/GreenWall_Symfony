<?php

namespace App\Controller;

use App\Entity\ShowCaseProject;
use App\Form\ShowCaseProjectType;
use App\Repository\ShowCaseProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projects')]
class ShowCaseProjectController extends AbstractController
{
    #[Route('/', name: 'show_case_project_index', methods: ['GET'])]
    public function index(ShowCaseProjectRepository $showCaseProjectRepository): Response
    {
        return $this->render('show_case_project/index.html.twig', [
            'show_case_projects' => $showCaseProjectRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'show_case_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $showCaseProject = new ShowCaseProject();
        $form = $this->createForm(ShowCaseProjectType::class, $showCaseProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($showCaseProject);
            $entityManager->flush();

            return $this->redirectToRoute('show_case_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('show_case_project/new.html.twig', [
            'show_case_project' => $showCaseProject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show_case_project_show', methods: ['GET'])]
    public function show(ShowCaseProject $showCaseProject): Response
    {
        return $this->render('show_case_project/show.html.twig', [
            'show_case_project' => $showCaseProject,
        ]);
    }

    #[Route('/{id}/edit', name: 'show_case_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShowCaseProject $showCaseProject): Response
    {
        $form = $this->createForm(ShowCaseProjectType::class, $showCaseProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_case_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('show_case_project/edit.html.twig', [
            'show_case_project' => $showCaseProject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show_case_project_delete', methods: ['POST'])]
    public function delete(Request $request, ShowCaseProject $showCaseProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$showCaseProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($showCaseProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('show_case_project_index', [], Response::HTTP_SEE_OTHER);
    }
}
