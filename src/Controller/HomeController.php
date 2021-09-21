<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/policy', name: 'policy')]
    public function cookiesPolicy(): Response
    {
        return $this->render('policy.html.twig', [
            "companyId" => "ES0000000N",
            "companyName" => "GreenWall SL",
            'companyMobile' => "645962530",
            'companyEmail' => 'green.wall.estore@gmail.com',
            'companyDirection' => "Calle de la ficción e inexistente 46. Distrito de mentira, 28006. MADRID, España"

        ]);
    }
}
