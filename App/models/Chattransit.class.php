<?php

require_once 'Conexao.class.php';

class Chattransit
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function msgsChattransit($data, $sessAtend, $sessClien, $msg, $tipo)
    {

        if ($this->con->exec("INSERT INTO chattransit (data, ssatend, ssclien, msg, tipo) VALUES ('{$data}', '{$sessAtend}', '{$sessClien}', '{$msg}', '{$tipo}')")) {
            return true;
        }

        return false;
    }

    function buscaMsgsAtendente($sessao, $tipo)
    {
        $mensagem = $this->con->query("SELECT msg FROM chattransit WHERE ssatend = '{$sessao}' AND tipo = '{$tipo}' AND msg <> ''");

        if (count($mensagem) > 0) {

            return $mensagem->fetch(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    function deleteMsgAtendente($ssAtend, $msg, $tipo)
    {
        if ($this->con->exec("DELETE FROM chattransit WHERE ssatend = '{$ssAtend}' AND tipo = '{$tipo}' AND msg = '{$msg}'")) {

            return TRUE;
        }

        return FALSE;
    }

    function buscaMsgsCliente($sessao, $tipo)
    {
        $mensagem = $this->con->query("SELECT msg FROM chattransit WHERE ssclien = '{$sessao}' AND tipo = '{$tipo}' AND msg <> ''");

        if (count($mensagem) > 0) {

            return $mensagem->fetch(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    function deleteMsgCliente($ssCliente, $msg)
    {
        if ($this->con->exec("DELETE FROM chattransit WHERE ssclien = '{$ssCliente}' AND msg = '{$msg}'")) {

            return TRUE;
        }

        return FALSE;
    }


}