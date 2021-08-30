<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/{page}', name: 'product_index', methods: ['GET'], defaults: ['page' => 1], requirements: ["page" => "\d+"])]
    public function index(CategoryRepository $cr ,ProductRepository $productRepository, $page = 1): Response
    {

        $products = $productRepository->findByCategoryFilter($page);

        dump($products);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'page' => $page,
            'categories' => $cr->getCategories(),
            'totalPages' => ceil(count($products) / 24),
            #'categories' => $selectedCategories
        ]);
    }


    #[Route('/{category}', name: 'product_category', methods: ['GET'])]
    public function category(Category $category, ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'productos' => $productRepository->findBy(),
            'subcategoria' => $category
        ]);
    }

    #[Route('/new', name: 'product_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, [
            'require_price' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'product_show', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function show(Int $id, ProductRepository $pr): Response
    {

        $product = $pr->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Product does not exist.");
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
}
