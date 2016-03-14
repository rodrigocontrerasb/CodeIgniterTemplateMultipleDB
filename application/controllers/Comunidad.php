<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller: Comunidad 
 * Descripcion: Controlador para la clase del tipo Comunidad
 * Objetivo: Disponibilizar los llamados de funciones en el controlador
 * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
 * @version 2016-03-07
 * @version 2016-03-13 - Actualiza estatus json en response login
 * @since 2016-03-07
 */
class Comunidad extends CI_Controller {

    /**
     * Funcion: index  
     * Descripcion: Genera el home del controlador
     * @param --
     * @return view
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-07
     * @since 2016-03-07
     */
    public function index() {

        // Load Vista
        //$this->load->view('posts/index');
        // Redireccion a carpeta web
        header('Location: ./web');
    }

    /**
     * Funcion: listarPosts   
     * Descripcion: Lista todos los posts
     * @param --
     * @return view $data
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-07
     * @since 2016-03-07
     */
    public function listarcomunidades() {

        // Carga Modelos
        $this->load->model('Comunidad_model');

        // Ejecucion funciones modelos
        $data['posts'] = $this->Comunidad_model->get_comunidades();

        // Vista
        $this->load->view('posts/listarposts', $data);
    }

    /**
     * Funcion: listarComunidad   
     * Descripcion: Lista una comunidad por suj id
     * @param $id_comunidad
     * @return view $data
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-07
     * @since 2016-03-07
     */
    public function listarcomunidad($id_comunidad) {

        // Carga Modelos
        $this->load->model('Comunidad_model');

        // Ejecucion funciones modelos
        $data['posts'] = $this->Comunidad_model->get_comunidad();

        // Vista
        $this->load->view('posts/listarposts', $data);
    }

    /**
     * Funcion: login   
     * Descripcion: Recibe el llamado POST de login de usuario
     * @param $_POST
     * @return --
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-11
     * @since 2016-03-11
     */
    public function login() {

        // Valores Post
        $arrInput = $this->input->post();

        // Carga Modelos
        $this->load->model('Comunidad_model');
        $this->load->model('Usuario_model');

        // Include Modelos DB
        $this->load->model('tables/Usuario_table');
        $this->load->model('tables/Comunidad_table');

        // Buscar Comunidad en BD
        $comunidad = new Comunidad_table();
        $comunidad = $this->Comunidad_model->get_comunidad($arrInput['id_comunidad']);

        // Buscar Usuario en BD de la comunidad, Usuario Model
        $usuario = new Usuario_table();
        $usuario = $this->Usuario_model->getUsuario($comunidad, $arrInput);

        // Verifica salida, si usuario existe y datos son correctos, crea session y redirige a index
        // caso contrario muestra mensaje de error (usuario inexistente, password incorrecta)
        if ($usuario->getId() != "") {
            echo 'Usuario Correcto';

            // Crear sesion con datos de BD y de usuario
            session_start();
            $_SESSION['comunidad'] = $comunidad;
            $_SESSION['usuario'] = $usuario;


            // Sesion Usuario
            $_SESSION['usr']['id'] = $usuario->id;
            $_SESSION['usr']['display_name'] = $usuario->display_name;
            $_SESSION['usr']['user_email'] = $usuario->user_email;


            // Session Comunidad
            $_SESSION['com']['id'] = $comunidad->getId();
            $_SESSION['com']['nombre'] = $comunidad->getNombre();
            $_SESSION['com']['server'] = $comunidad->getServer();
            $_SESSION['com']['db'] = $comunidad->getDb();
            $_SESSION['com']['user'] = $comunidad->getUser();
            $_SESSION['com']['pass'] = $comunidad->getPass();
            $_SESSION['com']['id_estado'] = $comunidad->getId_estado();

            // Redirect a la Pagina principal de la comunidad
            header("Location: ../../web/index.html");

            //$data['posts']['status'] = 1;
            //$data['posts']['msg'] = 'Usuario Correctamente Validado';
        } else {
            echo 'Datos de usuario incorrectos';
            //$data['posts']['status'] = 0;
            //$data['posts']['msg'] = 'Datos de usuario incorrectos';
        }


        // Vista
        //$this->load->view('posts/listarposts', $data);
    }

    /**
     * Funcion: validasession   
     * Descripcion: Verifica si existe session de usuario
     * @param $_POST
     * @return --
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-11
     * @since 2016-03-11
     */
    public function validasession() {

        session_start();


        if (isset($_SESSION['usuario'])) {
            //echo '1';

            $data['posts']['status'] = 1;
            $data['posts']['usuario']['id'] = $_SESSION['usr']['id'];
            $data['posts']['usuario']['display_name'] = $_SESSION['usr']['display_name'];
            $data['posts']['usuario']['user_email'] = $_SESSION['usr']['user_email'];
            $data['posts']['comunidad']['nombre'] = $_SESSION['com']['nombre'];
        } else {
            //echo '0';

            $data['posts']['status'] = 0;
        }

        // Vista
        $this->load->view('posts/listarposts', $data);
    }

    /**
     * Funcion: cerrarsession   
     * Descripcion: Elimina la session y cookie
     * @param --
     * @return --
     * @throws Exception
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-11
     * @since 2016-03-11
     */
    public function cerrarsession() {
        session_start();
        session_destroy();
        unset($_SESSION);

        echo '1';
    }

}
