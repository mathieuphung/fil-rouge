<?php
namespace Joli\BlogBundle\Controller;

use Joli\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PostingController extends Controller
{

    /**
     * @Route("/blog/propose")
     * @Template("Posts/posting")
     */
    public function postingAction(Request $request)
    {
        $task = new Post();

        $form = $this->createFormBuilder($task)
            ->add('title', 'text')
            ->add('body', 'text')
            ->add('slug', 'text')
            ->add('published', 'checkbox', array(
                'required' => false,
            ))
            ->add('save', 'submit', array('label' => 'Create post'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('post_success');
        }

        return $this->render(
            "JoliBlogBundle:Posts:posting.html.twig",
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/blog/post_success")
     * @Template("Posts/posting_success")
     */
    public function postingSuccessAction()
    {
        return $this->render(
            "JoliBlogBundle:Posts:posting_success.html.twig",
            array(
            )
        );
    }
    
}