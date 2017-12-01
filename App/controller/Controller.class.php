<?php

session_start();

class Controller
{

    function  statusAtendente()
    {
        $atend = new Atendente();

        $result = $atend->buscaAtendDisponivel();

        return $result;
    }

    function atendenteLogou($sessao, $nome, $status)
    {
        $atend = new Atendente();

        $result = $atend->atendLogado($sessao, $nome, $status);

        return $result;
    }

    function atualizaStatusAtendente($sessao, $status, $atendendo, $ssCliente)
    {
        $atend = new Atendente();

        $result = $atend->updateStatus($sessao, $status, $atendendo, $ssCliente);

        return $result;
    }

    function buscaNomeAtendente($ssAtend)
    {
        $atend = new Atendente();

        $result = $atend->buscaNomeAtend($ssAtend);

        return $result;
    }

    function checaStatusAtendente($sessao, $status)
    {
        $atend = new Atendente();

        $result = $atend->checaStatusAtendente($sessao, $status);

        return $result;
    }

    function clienteLogou($sessao, $nome, $status)
    {
        $cliente = new Cliente();

        $result = $cliente->clienteLogado($sessao, $nome, $status);

        return $result;
    }

    function buscaNomeCliente($ssAtend)
    {
        $atend = new Cliente();

        $result = $atend->buscaNomeCliente($ssAtend);

        return $result;
    }

    function checaStatusCliente($sessao, $status)
    {
        $cliente = new Cliente();

        $result = $cliente->checaStatusCliente($sessao, $status);

        return $result;
    }

    function buscarClienteChattransit($ssAtend)
    {
        $chattrans = new Chattransit();

        $result = $chattrans->buscarCliente($ssAtend);

        return $result;
    }

    function msgChatbkp($data, $ssAtend, $ssClient, $msg, $tipo)
    {
        $chat = new Chatbkp();

        $result = $chat->msgsChatbkp($data, $ssAtend, $ssClient, $msg, $tipo);

        return $result;

    }

    function msgChattransit($data, $ssAtend, $ssClient, $msg, $tipo)
    {
        $chat = new Chattransit();

        $result = $chat->msgsChattransit($data, $ssAtend, $ssClient, $msg, $tipo);

        return $result;

    }

    function buscaMsgsAtend($ssAtend, $tipo)
    {
        $chat = new Chattransit();

        $result = $chat->buscaMsgsAtendente($ssAtend, $tipo);

        return $result;
    }

    function deletarMsgAtend($ssAtend, $msg, $tipo)
    {
        $chat = new Chattransit();

        $result = $chat->deleteMsgAtendente($ssAtend, $msg, $tipo);

        return $result;
    }

    function buscaMsgsClie($ssCliente, $tipo)
    {
        $chat = new Chattransit();

        $result = $chat->buscaMsgsCliente($ssCliente, $tipo);

        return $result;
    }

    function deletarMsgClie($ssCliente, $msg)
    {
        $chat = new Chattransit();

        $result = $chat->deleteMsgCliente($ssCliente, $msg);

        return $result;
    }
}