<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    
    /**
     * Funcion: crear_comunidad_session   
     * Descripcion: Crea comunidad a partir de los datos en session
     * @param --
     * @return $comunidad
     * @throws --
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-03-11
     * @since 2016-03-11
     */
    function crear_comunidad_session(){
        
        $comunidad = new Comunidad_table();
        $comunidad->setId($_SESSION['com']['id']);
        $comunidad->setNombre($_SESSION['com']['nombre']);
        $comunidad->setServer($_SESSION['com']['server']);
        $comunidad->setDb($_SESSION['com']['db']);
        $comunidad->setUser($_SESSION['com']['user']);
        $comunidad->setPass($_SESSION['com']['pass']);
        $comunidad->setId_estado($_SESSION['com']['id_estado']);
        
        // Retorno
        return $comunidad;
    }
    
    
    /**
     * Funcion: get_posts   
     * Descripcion: lista los Posts
     * @param $id_tax
     * @return $salida
     * @throws --
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-02-08
     * @since 2016-02-08
     */
    function get_posts($id_tax) {

        // Include Modelos DB
        $this->load->model('tables/Posts_table');
        $this->load->model('tables/Comunidad_table');

        $comunidad = $this->crear_comunidad_session();
        
        // ------------------------------------------------------------
        // Conexion
        $this->load->model('Conn_model');
        //$link = $this->Conn_model->Conexion();
        $link = $this->Conn_model->ConexionComunidadReg($comunidad);


        $ssql = "select 
            wp_posts.ID, 
            wp_posts.post_title, 
            wp_posts.guid,
            wp_posts.post_content, 
            wp_posts.post_date, 
            wp_posts.post_author, 
            wp_posts.post_modified, 
            wp_posts.post_name, 
            wp_term_relationships.object_id, 
            wp_term_relationships.term_taxonomy_id,
            wp_users.display_name 
            from wp_posts 
            left join wp_term_relationships 
            on wp_posts.ID = wp_term_relationships.object_id 
            left join wp_users
            on wp_posts.post_author = wp_users.ID
            where wp_posts.post_status = 'publish' 
            and wp_posts.post_type = 'post' and 
            wp_term_relationships.term_taxonomy_id = " . $id_tax . " order by wp_posts.id desc";


        // Ejecucion Consulta
        $result = mysqli_query($link, $ssql);

        // Arreglo Consulta
        $x = 0;
        $salida = array();
        while ($row = mysqli_fetch_assoc($result)) {

            // Creacion de Objeto
            $post = new Posts_table();
            $post = $this->toPosts($post, $row);

            // Agregar al array de salida;
            $salida[$x] = $post;
            $x++;
        }

        // Cerrar Conexion
        mysqli_close($link);

        // Retorno
        return $salida;
    }

    /**
     * Funcion: get_post   
     * Descripcion: Obtiene un post desde la BD
     * @param $id_post
     * @return $salida
     * @throws --
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-02-24
     * @since 2016-02-24
     */
    function get_post($id_post) {

        
        $comunidad = $this->crear_comunidad_session();
        
        // Include Modelos DB
        $this->load->model('tables/Posts_table');

        // Conexion
        $this->load->model('Conn_model');
        //$link = $this->Conn_model->Conexion();
        $link = $this->Conn_model->ConexionComunidadReg($comunidad);

        // Consulta
        $ssql = "select * from wp_posts where ID = " . $id_post . " and post_status = 'publish' and post_type = 'post' order by id desc";

        // Ejecucion Consulta
        $result = mysqli_query($link, $ssql);

        // Arreglo Consulta
        $row = mysqli_fetch_assoc($result);

        // Creacion de Objeto
        $post = new Posts_table();
        $post = $this->toPosts($post, $row);

        // Cerrar Conexion
        mysqli_close($link);

        // Retorno
        return $post;
    }

    /**
     * Funcion: toPosts   
     * Descripcion: Rellena el objeto del tipo desde la BD
     * @param Posts_table $post, $row
     * @return $option
     * @throws --
     * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
     * @version 2016-02-24
     * @since 2016-02-24
     */
    function toPosts(Posts_table $post, $row) {

        try {
            $post->setId(utf8_encode($row['ID']));
        } catch (Exception $ex) {
            
        }

        try {
            $post->setPost_title(utf8_encode($row['post_title']));
        } catch (Exception $ex) {
            
        }

        try {
            $post->setGui(utf8_encode($row['guid']));
        } catch (Exception $ex) {
            
        }

        try {
            $post->setPost_content(utf8_encode($row['post_content']));
        } catch (Exception $exc) {
            
        }

        try {
            $post->setPost_date(utf8_encode($row['post_date']));
        } catch (Exception $exc) {
            
        }

        try {
            $post->setPost_author(utf8_encode($row['post_author']));
        } catch (Exception $exc) {
            
        }

        try {
            $post->setPost_modified(utf8_encode($row['post_modified']));
        } catch (Exception $exc) {
            
        }

        try {
            $post->setPost_name(utf8_encode($row['post_name']));
        } catch (Exception $exc) {
            
        }

        try {
            $post->setDisplay_name(utf8_encode($row['display_name']));
        } catch (Exception $exc) {
            
        }


        return $post;
    }

}
