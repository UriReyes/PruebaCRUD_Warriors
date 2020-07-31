<?php

namespace AppBundle\Controller;

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
          #Para utilizar Doctrine
          $em = $this->getDoctrine()->getManager();
          #Una vez obtenido el manager de doctrine
          $repository = $em->getRepository('AppBundle:Estudiante');
          $estudiantes = $repository->findBy(array(),array('id' => 'ASC'));
          return $this->render('default/index.html.twig',array(
              'estudiantes'=>$estudiantes,
          ));
    }
}
