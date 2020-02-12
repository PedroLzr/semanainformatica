<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Taller;
use App\Entity\Categoriataller;

class TallerController extends AbstractController{
    /**
    * @Route("/talleres", name="listar_talleres")
    */
    public function ponencias(){
        $repositorio = $this->getDoctrine()->getRepository(Taller::class);
        $talleres = $repositorio->findAll();


        return $this->render('talleres.html.twig', array("talleres" => $talleres));
    }

    /**
     * @Route("/editartaller/{id}", name="editar_taller")
     */
    public function editarTaller(Request $request, $id){
        $repositorio = $this->getDoctrine()->getRepository(Taller::class);
        $taller = $repositorio->find($id);

        $formulario = $this->createFormBuilder($taller)
            ->add('titulota', TextType::class, array('label' => 'Título'))
            ->add('categoriataller_id', EntityType::class, array('class' => Categoriataller::class, 'choice_label' => 'nombre', 'label' => 'Categoría'))
            ->add('liketa', NumberType::class, array('label' => 'Me gustas'))
            ->add('save', SubmitType::class, array('label' => 'Editar taller'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $taller = $formulario->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taller);
            $entityManager->flush();
            return $this->redirectToRoute('listar_talleres');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView()));
    }

    /**
     * @Route("/eliminartaller/{id}", name="eliminar_taller")
     */
    public function eliminar($id){

        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Taller::class);
        $taller = $repositorio->find($id);
        $entityManager->remove($taller);
        $entityManager->flush();

        return $this->redirectToRoute('listar_talleres');
    }

    /**
     * @Route("/nuevotaller/", name="nuevo_taller")
     */
    public function nuevoTaller(Request $request){

        $taller = new Taller();

        $formulario = $this->createFormBuilder($taller)
            ->add('titulota', TextType::class, array('label' => 'Título'))
            ->add('categoriataller_id', EntityType::class, array('class' => Categoriataller::class, 'choice_label' => 'nombre', 'label' => 'Categoría'))
            ->add('save', SubmitType::class, array('label' => 'Nuevo taller'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $taller = $formulario->getData();
            $taller->setLiketa(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taller);
            $entityManager->flush();
            return $this->redirectToRoute('listar_talleres');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView()));
    }

    /**
     * @Route("/sumarliketaller/{id}", name="sumar_like_taller")
     */
    public function sumarLikeTaller($id){
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Taller::class);
        $taller = $repositorio->find($id);
        $taller->setLiketa($taller->getLiketa()+1);
        $entityManager->persist($taller);
        $entityManager->flush();

        return $this->redirectToRoute('listar_talleres');
    }

    /**
     * @Route("/restarliketaller/{id}", name="restar_like_taller")
     */
    public function restarLikeTaller($id){
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Taller::class);
        $taller = $repositorio->find($id);
        $likes = $taller->getLiketa();
        if($likes > 0){
            $taller->setLiketa($likes-1);
            $entityManager->persist($taller);
            $entityManager->flush();
        }

        return $this->redirectToRoute('listar_talleres');
    }
}

?>