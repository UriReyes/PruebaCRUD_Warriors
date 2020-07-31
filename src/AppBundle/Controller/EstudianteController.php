<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Estudiante;
use App\Form\RegisterStudent;

class EstudianteController extends Controller
{
    /**
    * @Route("/estudiante/registrar", name="insert_estudiante", defaults={"id" = null})
    */

    public function insertEstudiante(Request $request){
        $estudiante = new Estudiante();
        $formulario = $this->createForm(RegisterStudent::class, $estudiante);
        $formulario->handleRequest($request);
        # Comprobar si el formulario se envió
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            # Guardamos el estudiante
            $em = $this->getDoctrine()->getManager();
            $em->persist($estudiante);
            $em->flush();
            $this->addFlash('success','Estudiante añadido');
            return $this->redirectToRoute('get_estudiante');
        }
        return $this->render('estudiante/formulario.html.twig',array(
            'form'=>$formulario->createView()
        ));
    }

    /**
    * @Route("/estudiante/update/{id}", name="update_estudiante", requirements={"id" = "\d+"}, defaults={"id" = 0})
    */

    public function editEstudiante(Request $request, Estudiante $estudiante){

        $formulario = $this->createForm(RegisterStudent::class, $estudiante);
        $formulario->handleRequest($request);
        # Comprobar si el formulario se envió
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            # Guardamos el estudiante
            $em = $this->getDoctrine()->getManager();
            $em->persist($estudiante);
            $em->flush();
            $this->addFlash('success','Estudiante editado');
            return $this->redirectToRoute('get_estudiante');
        }
        return $this->render('estudiante/formulario.html.twig',array(
            'edit'=>true,
            'nombre'=>$estudiante->getNombre(),
            'form'=>$formulario->createView()
        ));
    }
    /**
    * @Route("/estudiante/remove/{id}", name="remove_estudiante")
    */

    public function removeEstudiante(Request $request){
        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $estudiante = $em->getRepository('AppBundle:Estudiante')->find($id);
        if (!empty($estudiante)) {
            $em->remove($estudiante);
            $em->flush();
            $this->addFlash('success', 'Estudiante eliminado con éxito');
        }else{
            $this->addFlash('error', 'No se encontró el estudiante');
        }
        return $this->redirectToRoute('get_estudiante');
    }

    /**
    * @Route("/estudiantes", name="get_estudiante")
    */

    public function getAllEstuiantes(){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Estudiante');
        $estudiantes = $repository->findBy(array(),array('id' => 'ASC'));
        return $this->render('estudiante/index.html.twig',array(
            'estudiantes'=>$estudiantes,
        ));
    }

}
