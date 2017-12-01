<?php

require_once 'Conexao.class.php';

class Chatbkp
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function msgsChatbkp($data, $sessAtend, $sessClien, $msg, $tipo)
    {

        if ($this->con->exec("INSERT INTO chatbkp (data, ssatend, ssclien, msg, tipo) VALUES ('{$data}', '{$sessAtend}', '{$sessClien}', '{$msg}', '{$tipo}')")) {
            return true;
        }

        return false;
    }
}