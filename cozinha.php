<?php
include "config/conexao.php";

$sql = mysql_query("SELECT * FROM config");
$ver = mysql_fetch_array($sql);

if($_GET['deleta'] == "deleta"){ 

	$del = mysql_query("DELETE FROM cozinha WHERE qtd='1' OR produto =''") or die(mysql_error());
	if($del == 1){
?>
<script type="text/javascript">window.close();</script>	
	
<?php } }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imprimir para cozinha</title>

<style type="text/css">
body,td,th {
	font-family: "Courier New", Courier, monospace; font-size:16px;
}
.titulo{font-size:16px;}
hr{ color:#f2f2f2;}
</style>
</head>

<body>
<table width="100%" border="0" class="inputs">
  <tr>
  <?php 
  
 $mesa = $_GET['id_mesa'];
 $iten = $_GET['nome'];
 	
	$grava = mysql_query("INSERT INTO cozinha (produto, qtd)VALUES('$iten','1')") or die(mysql_error());
  ?>
  <td align="center"><strong><span class="titulo">Mesa nº: <?php echo $mesa ?></span></strong></td>
  </tr>
  <tr>
    <td align="center"><?php echo $ver['empresa']?> <br/> Anicuns - <?php echo date("d/m/Y - H:i:s"); ?></td>
  </tr>
    <tr>
    <td><hr/></td>
    </tr>
  </tr>
</table>
<table width="100%">
    <tr>
	  <td width="70%"><strong>Produtos</strong></td>
	  <td width="30%" align="center"><strong>Quantidade</strong></td>
  </tr>
	<?php 
	$mostra = mysql_query("SELECT produto, SUM(qtd) AS quantidade FROM cozinha GROUP BY produto ")or die(mysql_error());
	while($ver = mysql_fetch_array($mostra)){
		$qtd = $ver['quantidade'];
	?>
  <tr class="fontcomanda">
    <td align="left" bgcolor="#FFFFFF" class="btn"><?php echo $ver['produto']; ?> </td>
    <td align="center" bgcolor="#FFFFFF" class="btn"><?php echo $qtd; ?></td>
  </tr>
  <?php } ?>
	<tr class="fontcomanda">
	  <td colspan="2" align="left" class="btn">&nbsp;</td>
	  <?php $totals = number_format($total, 2, ',', '.'); ?>
  </tr>
	<tr class="fontcomanda">
    <?php //$handle = printer_open("CutePDF Writer");?>
	  <td colspan="2" align="center" class="btn"></td>
  </tr>   
</table>
 <br/>
<hr />
<br/>
	
<table width="100%">
 
	<tr class="fontcomanda">
    <?php //$handle = printer_open("CutePDF Writer");?>
	  <td width="100%" colspan="3" align="center" class="btn"><a href="?deleta=deleta" onClick="window.print();"><img src="imagens/icon_imprime.jpg" width="60" height="60" border="0" /></a></td>
  </tr>   
    </table>
    <?php
    if($_GET['deleta'] == "deleta"){ 

	$del = mysql_query("TRUNCATE TABLE cozinha") or die(mysql_error());
	if($del == 1){
?>
<script type="text/javascript">window.close();</script>	
	
<?php } }?>
</body>
</html>