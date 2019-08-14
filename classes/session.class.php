<?php

require "site.class.php";

class Session extends Site
{

    private $id;
    private $nome;
    private $email;
    private $senha;


    public function __construct()
    {
        parent::__construct();
    }

    function Login(){

    }

    static function veficaSession(){

    }

    function Logout(){

    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNome()
    {
        return $this->nome;
    }

}