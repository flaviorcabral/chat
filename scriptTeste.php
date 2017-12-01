<?php

require_once 'config.php';

$con = new Controller();
$conexao = new Conexao();
$atend = new Atendente();
$chat = new Chattransit();

$result = $chat->buscarCliente('m068hoohf3ejk030mjid85acr2');

var_dump($result);

