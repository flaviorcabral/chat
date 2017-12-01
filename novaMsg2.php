<?php

include 'config.php';

$con = new Controller();

$msg = $_REQUEST["msg"];

$nomeAtendente = $_SESSION['nomeAtendente'];
$ssAtend = $_SESSION['ssAtend'];
$atendendo = $con->buscarClienteChattransit($ssAtend);
var_dump($ssAtend);

// use esta linha para evitar problemas de acentuação (caso seu BD esteja com outra codificação)
$msg = utf8_decode($msg);

if(!empty($msg)) {
	// verifica se há usuário conectado
	$result = $con->checaStatusCliente($atendendo, 1);
	if($result)
		$con->msgChatbkp(date('Ymd H:i:s'), $ssAtend, $atendendo, $msg,'A');
		$con->msgChattransit(date('Ymd H:i:s'), $ssAtend, $atendendo, $msg, 'A');
}
?>