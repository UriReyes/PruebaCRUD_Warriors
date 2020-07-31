<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Grupo;
use App\Form\ResgisterGroup;

class GrupoController extends Controller
{

    /**
     * @Route("/grupo/registrar", name="insert_grupo", defaults={"id" = null})
     */

    public function insertGrupo(Request $request){
        $grupo = new Grupo();
        $formulario = $this->createForm(ResgisterGroup::class, $grupo);
        $formulario->handleRequest($request);
        # Comprobar si el formulario se envió
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            # Guardamos el grupo
            $em = $this->getDoctrine()->getManager();
            $em->persist($grupo);
            $em->flush();
            $this->addFlash('success','Grupo añadido');
            return $this->redirectToRoute('get_grupo');
        }
        return $this->render('grupo/formulario.html.twig',array(
            'form'=>$formulario->createView()
        ));
    }

    /**
     * @Route("/grupo/update/{id}", name="update_grupo", requirements={"id" = "\d+"}, defaults={"id" = 0})
     */

    public function editGrupo(Request $request, Grupo $grupo){
        $formulario = $this->createForm(ResgisterGroup::class, $grupo);
        $formulario->handleRequest($request);
        # Comprobar si el formulario se envió
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            # Guardamos el grupo
            $em = $this->getDoctrine()->getManager();
            $em->persist($grupo);
            $em->flush();
            $this->addFlash('success','Grupo editado');
            return $this->redirectToRoute('get_grupo');
        }
        return $this->render('grupo/formulario.html.twig',array(
            'edit'=>true,
            'grupo'=>$grupo->getGrupo(),
            'form'=>$formulario->createView()
        ));
        
    }

     /**
     * @Route("/grupo/remove/{id}", name="remove_grupo")
     */

    public function removeGrupo(Request $request){
        try{
            $id=$request->get('id');
            #Para utilizar Doctrine
            $em = $this->getDoctrine()->getManager();
            $grupo = $em->getRepository('AppBundle:Grupo')->find($id);
            #Una vez obtenido el manager de doctrine
            if (!empty($grupo)) {
                $em->remove($grupo);
                $em->flush();
                $this->addFlash('success', 'Grupo eliminado con éxito');
            }else{
                $this->addFlash('error', 'No se encontró el grupo');
            }
            return $this->redirectToRoute('get_grupo');
        } catch (\Doctrine\DBAL\DBALException $e) {
                $exception_message = $e->getPrevious()->getCode();
            return $this->render('errors/error.html.twig', array(
                'error' => 'No se puede eliminar ya que el grupo contiene estudiantes'
            )); 
        } 
    }

    /**
     * @Route("/grupos", name="get_grupo")
     */

    public function getAllGrupo(){         
        #Para utilizar Doctrine
        $em = $this->getDoctrine()->getManager();
        #Una vez obtenido el manager de doctrine
        $repository = $em->getRepository('AppBundle:Grupo');
        $grupos = $repository->findBy(array(),array('id' => 'ASC'));
        return $this->render('grupo/index.html.twig',array(
            'grupos'=>$grupos,
        ));
    }

}
