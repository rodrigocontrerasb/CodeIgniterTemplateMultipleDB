<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo: Usuario
 * Descripcion: Representación en clase para tabla usuario
 * Objetivo: Controlar las llamadas de asignacion y retorno de valores para objetos del tipo
 * @author Rodrigo Contreras B. <rodrigo.rcb@gmail.com>
 * @version 2016-03-11
 * @since 2016-03-11
 */
class Usuario_table extends CI_Model {

    //Atributos de Tabla
    public $id = null;
    public $user_login = null;
    public $user_pass = null;
    public $user_nicename = null;
    public $user_email = null;
    public $user_url = null;
    public $user_registered = null;
    public $user_activation_key = null;
    public $user_status = null;
    public $display_name = null;

    // Getters
    function getId() {
        return $this->id;
    }

    function getUser_login() {
        return $this->user_login;
    }

    function getUser_pass() {
        return $this->user_pass;
    }

    function getUser_nicename() {
        return $this->user_nicename;
    }

    function getUser_email() {
        return $this->user_email;
    }

    function getUser_url() {
        return $this->user_url;
    }

    function getUser_registered() {
        return $this->user_registered;
    }

    function getUser_activation_key() {
        return $this->user_activation_key;
    }

    function getUser_status() {
        return $this->user_status;
    }

    function getDisplay_name() {
        return $this->display_name;
    }

    // Setters
    function setId($id) {
        $this->id = $id;
    }

    function setUser_login($user_login) {
        $this->user_login = $user_login;
    }

    function setUser_pass($user_pass) {
        $this->user_pass = $user_pass;
    }

    function setUser_nicename($user_nicename) {
        $this->user_nicename = $user_nicename;
    }

    function setUser_email($user_email) {
        $this->user_email = $user_email;
    }

    function setUser_url($user_url) {
        $this->user_url = $user_url;
    }

    function setUser_registered($user_registered) {
        $this->user_registered = $user_registered;
    }

    function setUser_activation_key($user_activation_key) {
        $this->user_activation_key = $user_activation_key;
    }

    function setUser_status($user_status) {
        $this->user_status = $user_status;
    }

    function setDisplay_name($display_name) {
        $this->display_name = $display_name;
    }

}
