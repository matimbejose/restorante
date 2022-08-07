<?php
include "../config/conexao.php";
header('Content-type: text/html; charset=UTF-8');
$mesa = $_GET['mesa'];

$conf = mysql_query("SELECT * FROM mesa WHERE numero = '$mesa'") or die(mysql_error());
$conferegarcon = mysql_fetch_array($conf);

$idGarcon = $conferegarcon['idGarcon'];

$cod	= $_GET['cod'];
$nome 	= $_GET['nome'];
$preco	= $_GET['preco'];
$qtd	= $_GET['qtd'];
$comanda	= $_GET['comanda'];
$data 	= date('Y-m-d H:i:s');
$destino = $_GET['destino'];
$time = date("H:i");

$cadastra = mysql_query("INSERT INTO tbl_carrinho (
						cod, nome, preco, qtd,comanda,data,id_mesa,situacao,idGarcon,destino,time
						) VALUES (
						'$cod', '$nome', '$preco', '$qtd', '$comanda', '$data','$mesa','1','$idGarcon','$destino','$time'
						)");
	
	if($cadastra == 1){
		print"<script type=\"text/javascript\">alert(\" 1 - $nome -  foi adicionado a mesa $mesa !\");</script>";
		echo'<script>javascript:window.history.go(-1)</script>';	
	}
	

?>