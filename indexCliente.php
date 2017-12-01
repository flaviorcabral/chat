<?php

include_once 'config.php';

$con = new Controller();

// Busca atendente está online e disponivel
$busca = $con->statusAtendente();

if(!$busca) {
	echo "<html>";
	echo "<body>";
	echo "<h2>No momento todos os atendentes estão ocupados! Tente mais tarde.</h2>";
	echo "</body>";
	echo "</html>";
	exit();
}

// exibe formulário de login
if(!isset($_POST["nome"]) || empty($_POST["nome"]))	{ 
?>
	<html>
		<body>
			<h2 align="center">Atendimento via chat </h2>
			<form name="login" method="post" action="indexCliente.php">
		  		<div align="center">
					<p>Seu nome: <input name="nome" type="text" id="nome" size="50" maxlength="60"></p>
					<p><input name="iniciar" type="submit" id="iniciar" value="Iniciar atendimento"></p>
		  		</div>
			</form>
		</body>
	</html>
<?php	
}
else {

	if($busca) {

		// inicia o chat
		$nomeCliente = ucfirst($_POST["nome"]);
		$ssCliente = session_id();
		$_SESSION['nomeCliente'] = $nomeCliente;
		$_SESSION['ssCliente'] = $ssCliente;
		//setcookie("nomeCliente", $nomeCliente);
		//setcookie("ssCliente", $ssCliente);


		$nomeAtendente = $busca[0]['nome'];
		$ssAtend = $busca[0]['sessao'];
		$_SESSION['ssAtend'] = $ssAtend;
		//setcookie("ssAtend", $ssAtend);

		$con->clienteLogou($ssCliente, $nomeCliente,'1');
		$con->msgChatbkp(date('Ymd H:i:s'),$ssAtend, $ssCliente, '[Entrou no chat]','C');
		$con->msgChattransit(date('Ymd H:i:s'),$ssAtend, $ssCliente, '[Entrou no chat]', 'C');
		$con->atualizaStatusAtendente($ssAtend, '1', $ssCliente, $ssCliente);

	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Chat de Atendimento</title>
		<script language="javascript" src="bibliotecaAjax.js"></script>
		<script language="javascript" src="chat.js"></script>
	</head>
	<body>
		<h2 align="center">Atendimento via chat </h2>
		<table width="600" border="0" align="center" cellpadding="0" cellspacing="3">
  			<tr>
    			<td bgcolor="#ECFFEC">
					<div id="texto" style="width:600px; height:300px; overflow:auto">
						<p style="background-color:#E9E9E9"><b><?php echo $nomeAtendente; ?>:</b> Olá <?php echo ucfirst($nomeCliente); ?>, seja bem-vindo ao nosso atendimento online. Em que posso ajudar?</p>
					</div>
				</td>
  			</tr>
			<tr>
    			<td>
					<form name="formAjax" action="javascript:void%200" onSubmit="EnviaMsg(this.msg.value); return false">
      					Sua Mensagem:
      					<input name="msg" type="text" id="msg" size="50" maxlength="150">
      					<input type="submit" name="Submit" value="Enviar">
    				</form>
				</td>
  			</tr>
		</table>
		<p align="center"><a href="javascript:window.close();">Sair do chat</a></p>
	</body>
</html>
<?php
}
?>