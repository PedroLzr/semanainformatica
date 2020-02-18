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
use App\Entity\Ponencia;
use App\Entity\Categoriaponencia;

class PonenciaController extends AbstractController{
    /**
    * @Route("/ponencias", name="listar_ponencias")
    */
    public function ponencias(Request $request){
        $ponencias = null;
        $formulario = $this->createFormBuilder()
            ->add('categoriaponencia_id', EntityType::class, array('class' => Categoriaponencia::class, 'choice_label' => 'nombre', 'label' => 'Categoría'))
            ->add('save', SubmitType::class, (array('label' => "Buscar")))
            ->getForm();
        $formulario->handleRequest($request);

        $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
        $ponencias = $repositorio->findAll();

        if($formulario->isSubmitted() && $formulario->isValid()){
            $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
            $ponencias = $repositorio->buscarPonenciasPorCategoria($formulario->getData()['categoriaponencia_id']);
        }

        return $this->render('ponencias.html.twig', array('formulario' => $formulario->createView(), 'ponencias' => $ponencias));


        //return $this->render('ponencias.html.twig', array("ponencias" => $ponencias));
    }

    /**
     * @Route("/editarponencia/{id}", name="editar_ponencia")
     */
    public function editarPonencia(Request $request, $id){
        $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
        $ponencia = $repositorio->find($id);

        $formulario = $this->createFormBuilder($ponencia)
            ->add('titulopo', TextType::class, array('label' => 'Título'))
            ->add('categoriaponencia_id', EntityType::class, array('class' => Categoriaponencia::class, 'choice_label' => 'nombre', 'label' => 'Categoría'))
            ->add('likepo', NumberType::class, array('label' => 'Me gustas'))
            ->add('save', SubmitType::class, array('label' => 'Editar ponencia'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $ponencia = $formulario->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ponencia);
            $entityManager->flush();
            return $this->redirectToRoute('listar_ponencias');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView(), 'titulo' => "Editar ponencia"));
    }

    /**
     * @Route("/eliminarponencia/{id}", name="eliminar_ponencia")
     */
    public function eliminar($id){

        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
        $ponencia = $repositorio->find($id);
        $entityManager->remove($ponencia);
        $entityManager->flush();

        return $this->redirectToRoute('listar_ponencias');
    }

    /**
     * @Route("/nuevaponencia/", name="nueva_ponencia")
     */
    public function nuevaPonencia(Request $request){

        $ponencia = new Ponencia();

        $formulario = $this->createFormBuilder($ponencia)
            ->add('titulopo', TextType::class, array('label' => 'Título'))
            ->add('categoriaponencia_id', EntityType::class, array('class' => Categoriaponencia::class, 'choice_label' => 'nombre', 'label' => 'Categoría'))
            ->add('save', SubmitType::class, array('label' => 'Nueva ponencia'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $ponencia = $formulario->getData();
            $ponencia->setLikepo(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ponencia);
            $entityManager->flush();
            return $this->redirectToRoute('listar_ponencias');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView(), 'titulo' => "Añadir Ponencia"));
    }

    /**
     * @Route("/sumarlikeponencia/{id}", name="sumar_like_ponencia")
     */
    public function sumarLikePonencia($id){
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
        $ponencia = $repositorio->find($id);
        $ponencia->setLikepo($ponencia->getLikepo()+1);
        $entityManager->persist($ponencia);
        $entityManager->flush();

        return $this->redirectToRoute('listar_ponencias');
    }

    /**
     * @Route("/restarlikeponencia/{id}", name="restar_like_ponencia")
     */
    public function restarLikePonencia($id){
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Ponencia::class);
        $ponencia = $repositorio->find($id);
        $likes = $ponencia->getLikepo();
        if($likes > 0){
            $ponencia->setLikepo($likes-1);
            $entityManager->persist($ponencia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('listar_ponencias');
    }
}

?>