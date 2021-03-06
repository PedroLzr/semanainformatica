<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;

class UsuarioController extends AbstractController{

    /**
    * @Route("/usuarios", name="listar_usuarios")
    */
    public function usuarios(){
        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repositorio->findAll();


        return $this->render('usuarios.html.twig', array("usuarios" => $usuarios));
    }

    /**
     * @Route("/nuevo_usuario", name="nuevo_usuario")
     */
    public function nuevoUsuario(Request $request){
        $usuario = new Usuario();

        $formulario = $this->createFormBuilder($usuario)
            ->add('user', TextType::class, array('label' => 'Nombre de usuario'))
            ->add('pass', PasswordType::class, array('label' => 'Contraseña'))
            ->add('email', EmailType::class, array('label' => 'Correo electrónico'))
            ->add('rol', ChoiceType::class, [
                'choices'  => [
                    'Usuario' => 'ROLE_USER',
                    'Administrador' => 'ROLE_ADMIN',
                ],
            ])
            ->add('save', SubmitType::class, array('label' => 'Añadir Usuario'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $usuario = $formulario->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();
            return $this->redirectToRoute('inicio');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView(), 'titulo' => "Añadir usuario"));
    }

    /**
     * @Route("/eliminarusuario/{id}", name="eliminar_usuario")
     */
    public function eliminar($id){

        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio->find($id);
        $entityManager->remove($usuario);
        $entityManager->flush();

        return $this->redirectToRoute('listar_usuarios');
    }

    /**
     * @Route("/editarusuario/{id}", name="editar_usuario")
     */
    public function editarUsuario(Request $request, $id){
        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $usuario = $repositorio->find($id);

        $formulario = $this->createFormBuilder($usuario)
            ->add('user', TextType::class, array('label' => 'Nombre'))
            ->add('email', TextType::class, array('label' => 'Correo electrónico'))
            ->add('rol', ChoiceType::class, [
                'choices'  => [
                    'Usuario' => 'ROLE_USER',
                    'Administrador' => 'ROLE_ADMIN',
                ],
            ])
            ->add('save', SubmitType::class, array('label' => 'Editar Usuario'))
            ->getForm();

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $usuario = $formulario->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();
            return $this->redirectToRoute('listar_usuarios');
        }

        return $this->render('formulario.html.twig', array('formulario' => $formulario->createView(), 'titulo' => "Editar usuario"));
    }
}

?>