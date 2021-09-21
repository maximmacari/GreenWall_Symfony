<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Product;
use App\Form\BasketType;
use App\Repository\BasketRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use SebastianBergmann\Environment\Console;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Validator\ViolationMapper\MappingRule;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/basket')]
class BasketController extends AbstractController
{

    #[Route('/client/{id}', name: 'basket_add_product', methods: ['GET'], defaults: ['id'], requirements: ['id' => '\d+'])]
    public function addProduct(Request $request, Int $id, ProductRepository $pr, UserRepository $ur): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $email = $request->query->get('email');
        dump($email);
        $user = $ur->findOneByEmail($email);
        $basket = $user->getBasket();
        $encoder = new JsonEncoder();
        $product = $pr->findOneById($id);
        $basket->addProduct($product);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($basket);
        $entityManager->flush();

        $defaultContext = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => [
                'categories', 'basket', 'password', 'roles', 'userIdentifier', 'username'
            ], #ignore properties that couse circular reference
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer(array($normalizer), array($encoder));

        $basketEncodedToJson = $serializer->serialize($basket, 'json', $defaultContext);

        $response = new Response(
            'Basket: ' . $basketEncodedToJson,
            Response::HTTP_OK,
            array('content-type' => 'application/json')
        );

        return $response;
    }

    #[Route('/', name: 'basket_index', methods: ['GET'])]
    public function index(BasketRepository $basketRepository): Response
    {
        return $this->render('basket/index.html.twig', [
            'baskets' => $basketRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'basket_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $basket = new Basket();
        $form = $this->createForm(BasketType::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($basket);
            $entityManager->flush();

            return $this->redirectToRoute('basket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('basket/new.html.twig', [
            'basket' => $basket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'basket_show', methods: ['GET'])]
    public function show(Basket $basket): Response
    {
        return $this->render('basket/show.html.twig', [
            'basket' => $basket,
        ]);
    }

    #[Route('/{id}/edit', name: 'basket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Basket $basket): Response
    {
        $form = $this->createForm(BasketType::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('basket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('basket/edit.html.twig', [
            'basket' => $basket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'basket_delete', methods: ['POST'])]
    public function delete(Request $request, Basket $basket): Response
    {
        if ($this->isCsrfTokenValid('delete' . $basket->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($basket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('basket_index', [], Response::HTTP_SEE_OTHER);
    }
}
