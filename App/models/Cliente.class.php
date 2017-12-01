<?php

require_once 'Conexao.class.php';

class Cliente
{

    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function clienteLogado($session, $nome, $status)
    {

        if ($this->con->exec("INSERT INTO cliente (sessao, nome, status) VALUES ('{$session}', '{$nome}', '{$status}')")) {
            return true;
        }

        return false;
    }

    function buscaNomeCliente($sessao)
    {
        $nome = $this->con->query("SELECT nome FROM cliente WHERE sessao = '{$sessao}'");

        if (count($nome) > 0) {

            return $nome->fetch(PDO::FETCH_COLUMN);
        }

        return FALSE;
    }

    function checaStatusCliente($sessao, $status)
    {
        $lista = $this->con->query("SELECT * FROM cliente WHERE sessao = '{$sessao}' AND status = '{$status}'");

        if (count($lista) > 0) {

            return $lista->fetchAll(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }
}