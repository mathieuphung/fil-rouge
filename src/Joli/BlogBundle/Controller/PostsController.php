<?php
namespace Joli\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostsController extends Controller
{
    /**
     * @Route("/blog")
     * @Template("Posts")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('JoliBlogBundle:Post')
            ->findAll();

        if (!$posts) {
            throw $this->createNotFoundException(
                'No posts found'
            );
        }

        return $this->render(
            "JoliBlogBundle:Posts:index.html.twig",
            array(
                'posts' => $posts
            )
        );
    }
}