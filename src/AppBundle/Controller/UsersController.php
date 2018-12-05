<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;



class UsersController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()){

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $roleRepository = $this->getDoctrine()->getRepository(Role::class);

            $userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);


            $user->addRole($userRole);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("security_login");
        }


        return $this->render("user/register.html.twig");
    }

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile()
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        return $this->render("user/profile.html.twig", ['user' => $user]);
    }

    public function showMyArticles()
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(Article::class);
        $authorId = $this
            ->getUser()
            ->getId();
        $articles = $repository->findBy(
            ['authorId' => $authorId],
            ['dateAdded' => 'DESC']
        );
        return $this->render('user/articles.html.twig',
            [
                'articles' => $articles
            ]);
    }

}
