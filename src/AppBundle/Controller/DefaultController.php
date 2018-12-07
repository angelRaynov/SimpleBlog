<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction()
    {
        $articles= $this->getDoctrine()->getRepository(Article::class)->findAll();
//        dump($articles);exit();
        return $this->render('blog/index.html.twig', ['articles' => $articles]);
    }
}
