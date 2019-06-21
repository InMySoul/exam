<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
        public function index(EntityManagerInterface $entityManager, Request $request)
    {
        $Post = new Message();
        $form = $this->createForm(PostType::class, $Post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($Post);
            $entityManager->flush();

            return $this->redirectToRoute('post');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
