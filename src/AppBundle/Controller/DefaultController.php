<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $articles= $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('blog/index.html.twig', ['articles' => $articles]);
    }
}
