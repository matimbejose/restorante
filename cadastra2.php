<?php
include "config/conexao.php";

$mesa = $_GET['mesa'];

$conf = mysql_query("SELECT * FROM pedido WHERE numero = '$mesa'") or die(mysql_error());
$conferegarcon = mysql_fetch_array($conf);

$idGarcon = $conferegarcon['idGarcon'];

$cod	= $_GET['cod'];
$nome 	= $_GET['nome'];
$preco	= $_GET['preco'];
$qtd	= $_GET['qtd'];
$comanda	= '0';
date_default_timezone_set('America/Sao_Paulo');
$data 	= date('Y-m-d H:i:s');
$destino = $_GET['destino'];
$time = date("H:i");

$cadastra = mysql_query("INSERT INTO entrega (
						cod, nome, preco, qtd,comanda,data,id_mesa,situacao,idGarcon,status,destino,entregue,time,feito
						) VALUES (
						'$cod', '$nome', '$preco', '$qtd', '$comanda', '$data','$mesa','1','$idGarcon','0','$destino','0','$time','0'
						)")or die (mysql_error());

?>
