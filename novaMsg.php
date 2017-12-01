<?php

include 'config.php';

$con = new Controller();

$msg = $_REQUEST["msg"];

$nomeCliente = $_SESSION['nomeCliente'];
$ssCliente = $_SESSION['ssCliente'];
$ssAtend = $_SESSION['ssAtend'];

// use esta linha para evitar problemas de acentuação (caso seu BD esteja com outra codificação)
$msg = utf8_decode($msg);

if(!empty($msg)) {
	// verifica se a sessão do usuário ainda está aberta
	$result = $con->checaStatusAtendente($ssAtend, 1);
	if ($result) {
		$con->msgChatbkp(date('Ymd H:i:s'), $ssAtend, $ssCliente, $msg, 'C');
		$con->msgChattransit(date('Ymd H:i:s'), $ssAtend, $ssCliente, $msg, 'C');
	} else {
		echo "<p>ATENDIMENTO J&Aacute; ENCERRADO! <a href=\"indexCliente.php\">Voltar</a></p>";
	}
}
?>