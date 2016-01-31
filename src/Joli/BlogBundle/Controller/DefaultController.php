<?php
namespace Joli\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/current-time")
     * @Template("Time_zone")
     */
    public function currentTimeAction()
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('h:i:s', time());

        return $this->render(
            "JoliBlogBundle:Time_zone:index.html.twig",
            array(
                'date'   => $date
            )
        );
    }

    public function squareAction($number)
    {
        $calculator = $this->get('calculator');

        return $this->render(
            "JoliBlogBundle:Square:index.html.twig",
            array(
                'square'   =>  $calculator->square($number)
            )
        );
    }
}
