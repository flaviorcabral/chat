<?php

include "config.php";

$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");
header("Content-Type: text/html; charset=ISO-8859-1");

$con = new Controller();

$mensagens="";

if((isset($_SESSION['ssCliente']) and (isset($_SESSION['ssAtend'])))) {

	$ssCliente = $_SESSION['ssCliente'];
	$ssAtend = $_SESSION['ssAtend'];

	$busca = $con->buscaMsgsAtend($ssAtend, 'A');
	$nomeAtend = $con->buscaNomeAtendente($ssAtend);


	if($busca){
		foreach ($busca as $msg) {
			$mensag = $msg;
			$mensagens .= "<p style=\"background-color:#E9E9E9\"><b>$nomeAtend:</b> $mensag</p>";
			$con->deletarMsgAtend($ssAtend, $mensag, 'A');
		}

		echo $mensagens;
	}
}
?>