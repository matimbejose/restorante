<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Griff sistemas - Pedidos a serem preparados</title>

<link href="css/css.css" rel="stylesheet" type="text/css">

<script type="text/javascript">

 function confirmariten(query){

 if (confirm ("Este prato ainda não foi preparado?")){   

 window.location="pedidoscozinha.php" + query;  

 return true;

 }

 else  

 window.location="pedidoscozinha.php";

 return false;

 }

 

 function confirmar(query){

 if (confirm ("Espte prato já preparado?")){   

 window.location="pedidoscozinha.php" + query;  

 return true;

 }

 else  

 window.location="pedidoscozinha.php";

 return false;

 }

</script>

</head>



<body>

<div id="geral">

<h1>&nbsp;&nbsp;&nbsp;Cozinha - Pedidos a serem preparados | <a href="sair.php">Sair</a></h1> 

<div id="mesas">

<?php 

include "config/conexao.php";


error_reporting(0);
if($_GET['acao'] == "mudar"){

	$id = $_GET['id'];

	$feito = $_GET['feito'];

	$sql = mysqli_query($connect,"UPDATE	tbl_carrinho SET feito = '$feito' WHERE id='$id'") or die(mysqli_error());

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=pedidoscozinha.php'>";

	//echo $feito;

	

	

}echo "<meta HTTP-EQUIV='refresh' CONTENT='5;'>";

/* if($_GET['retira'] == "produto"){

	$idDelete = $_GET['id'];

	$del = mysql_query("DELETE FROM tbl_carrinho WHERE id='$idDelete'");

	if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=garcon'>";	

	}

}*/

?>

<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:10px;">

<tr>

  <td align="center" bgcolor="<?php echo $background ?>"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:10px;">

    <tr>

      <td width="48%" align="left" bgcolor="#3399FF"><strong>Produto</strong></td>

      <td width="16%" align="center" bgcolor="#3399FF"><strong>Hora</strong></td>

      <td width="19%" align="center" bgcolor="#3399FF"><strong>Mesa</strong></td>

      <td width="9%" align="left" bgcolor="#3399FF"><strong>Garçom</strong></td>

      <td width="8%" align="center" bgcolor="#3399FF"><strong>Ação</strong></td>

    </tr>

    <?php 

  $sql = mysqli_query($connect, "SELECT * FROM tbl_carrinho INNER JOIN garcon ON tbl_carrinho.idGarcon = garcon.idGarcon WHERE destino='1' AND status = '0' ORDER BY id DESC") or die(mysqli_error());

  while($ver = mysqli_fetch_array($sql)){

	$background = (++$i%2) ? '#FFFFF' : '#F2F2F2';

	$feito = $ver['feito'];

  ?>

    <tr>

      <td bgcolor="<?php echo $background ?>"><?php echo $ver['nome']; ?></td>

      <td align="center" bgcolor="<?php echo $background ?>"><?php echo $ver['time']; ?></td>

      <td align="center" bgcolor="<?php echo $background ?>"><?php echo $ver['id_mesa'] ?></td>

      <td bgcolor="<?php echo $background ?>"><?php echo $ver['nomeGarcon'] ?></td>

      <td bgcolor="<?php echo $background ?>">

      <?php if($feito == 1){?>

      <a href="javascript:confirmariten('?acao=mudar&feito=0&id=<?php echo $ver['id']; ?>')">

      <img src="imagens/pronto.png" width="45" height="18" border="0" /></a>

      <?php }else{?>

      <a href="javascript:confirmar('?acao=mudar&feito=1&id=<?php echo $ver['id']; ?>')"><img src="imagens/AFAZER.png" width="45" height="18" border="0" /></a>

<?php } ?>

      </td>

	  <?php } ?>

    </tr>

  </table>  

</table>

</div>



</div>

</body>

</html>