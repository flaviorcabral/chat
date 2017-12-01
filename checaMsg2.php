<?php

include 'config.php';

$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");
header("Content-Type: text/html; charset=ISO-8859-1");

$con = new Controller();
$ssAtend = $_SESSION['ssAtend'];

$status = $con->checaStatusAtendente($ssAtend, 1);

if($status){

	$atendendo = $con->buscarClienteChattransit($ssAtend);

	$mensagens="";

	$busca = $con->buscaMsgsClie($atendendo, 'C');

	if($busca){
		$nomeCliente = $con->buscaNomeCliente($atendendo);

		foreach ($busca as $msg) {
			$mensag = $msg;
			$mensagens .= "<p style=\"background-color:#E9E9E9\"><b>$nomeCliente:</b> $mensag</p>";
			$con->deletarMsgClie($atendendo, $mensag, 'C');
		}

		echo $mensagens;
	}
}
?>