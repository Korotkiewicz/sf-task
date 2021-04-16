<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/health", name="health", methods={"GET"})
     */
    public function health(): Response
    {
        return new Response('No content', Response::HTTP_NO_CONTENT);
    }
}
