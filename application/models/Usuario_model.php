<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    function getUsuario(Comunidad_table $comunidad, $form) {

        // Include Modelos DB
        $this->load->model('tables/Usuario_table');

        // Conexion
        $this->load->model('Conn_model');
        $link = $this->Conn_model->ConexionComunidadReg($comunidad);

        // Consulta
        $ssql = "select * from wp_users where user_email = '" . $form['usuario'] . "'";
        //$ssql = "select * from wp_users";
        // Ejecucion Consulta
        $result = mysqli_query($link, $ssql);


        // Ejecucion Consulta
        $result = mysqli_query($link, $ssql);

        // Arreglo Consulta
        $x = 0;
        $salida = array();

        // Creacion de Objeto
        $usuario = new Usuario_table();
        
        while ($row = mysqli_fetch_assoc($result)) {

            $usuario = $this->toUsuario($usuario, $row);

            // Agregar al array de salida;
            $salida[$x] = $usuario;
            $x++;
        }

        // Cerrar Conexion
        mysqli_close($link);

        // Retorno
        //return $salida;
        return $usuario;
    }

    // ToComunidad
    function toUsuario(Usuario_table $usuario, $row) {

        try {
            if (isset($row['ID'])) {
                $usuario->setId(utf8_encode($row['ID']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_login'])) {
                $usuario->setUser_login(utf8_encode($row['user_login']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_pass'])) {
                $usuario->setUser_pass(utf8_encode($row['user_pass']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_nicename'])) {
                $usuario->setUser_nicename(utf8_encode($row['user_nicename']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_email'])) {
                $usuario->setUser_email(utf8_encode($row['user_nicename']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_url'])) {
                $usuario->setUser_url(utf8_encode($row['user_url']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_registered'])) {
                $usuario->setUser_registered(utf8_encode($row['user_registered']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_activation_key'])) {
                $usuario->setUser_activation_key(utf8_encode($row['user_activation_key']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['user_status'])) {
                $usuario->setUser_status(utf8_encode($row['user_status']));
            }
        } catch (Exception $ex) {
            
        }

        try {
            if (isset($row['display_name'])) {
                $usuario->setDisplay_name(utf8_encode($row['display_name']));
            }
        } catch (Exception $ex) {
            
        }


        return $usuario;
    }

}
