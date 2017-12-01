<?php

require_once 'Conexao.class.php';

class Atendente
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function atendLogado($session, $nome, $status)
    {

        if ($this->con->exec("INSERT INTO atendente (sessao, nome, status) VALUES ('{$session}', '{$nome}', '{$status}')"))
        {
            return true;
        }

        return false;
    }

    function updateStatus($sessao, $status, $atendendo, $atendendo)
    {

        if ($this->con->exec("UPDATE atendente SET status = '{$status}', atendendo = '{$atendendo}' WHERE sessao = '{$sessao}'")) {

            return TRUE;
        }

        return FALSE;
    }

    function buscaAtendDisponivel()
    {
        $lista = $this->con->query("SELECT * FROM atendente WHERE status = '0'");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    function buscaNomeAtend($sessao)
    {
        $lista = $this->con->query("SELECT nome FROM atendente WHERE sessao = '{$sessao}'");

        if (count($lista) > 0) {

            return $lista->fetch(PDO::FETCH_COLUMN);
        }

        return FALSE;
    }

    function checaStatusAtendente($sessao, $status)
    {
        $lista = $this->con->query("SELECT * FROM atendente WHERE sessao = '{$sessao}' AND status = '{$status}'");

        if (count($lista) > 0) {

            return $lista->fetchAll(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    function buscarCliente($ssAtend)
    {
        $cliente = $this->con->query("SELECT atendendo FROM chattransit WHERE ssatend = '{$ssAtend}'");

        if (count($cliente) > 0) {

            return $cliente->fetch(PDO::FETCH_COLUMN);
        }

        return FALSE
    }
}