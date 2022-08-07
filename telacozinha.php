<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="5;URL=http://localhost/sistemadevendaMobile/telacozinha.php"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<title>Griff:: Sistema de vendas para bares e restaurantes</title>
</head>

<body>

<div id="geral">
<h1 style="text-align:center;">Pedidos</h1>
<div id="mesas">
<?php 
include "config/conexao.php";
if($_GET['acao'] == "mudar"){
	$id = $_GET['id'];
	$sql = mysql_query("UPDATE	tbl_carrinho SET status = '1' WHERE id='$id'") or die(mysql_error());
	
}

?>
	
    <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:10px;">
  <tr>
    <td width="40%" align="left" bgcolor="#3399FF"><strong>Produto</strong></td>
    <td width="14%" align="center" bgcolor="#3399FF"><strong>Hora</strong></td>
    <td width="11%" align="center" bgcolor="#3399FF"><strong>Mesa</strong></td>
    <td width="26%" align="left" bgcolor="#3399FF"><strong>Garçom</strong></td>
    <td width="9%" align="center" bgcolor="#3399FF"><strong>Ações</strong></td>
  </tr>
  <?php 
  $sql = mysql_query("SELECT * FROM tbl_carrinho INNER JOIN garcon ON tbl_carrinho.idGarcon = garcon.idGarcon WHERE status='0' AND
  destino='1' ORDER BY id DESC") or die(mysql_error());
  while($ver = mysql_fetch_array($sql)){
	$background = (++$i%2) ? '#F9F9F9' : '#F1F1F1';
  ?>
  <tr>
    <td bgcolor="<?php echo $background ?>"><?php echo $ver['nome']; ?></td>
    <td align="center" bgcolor="<?php echo $background ?>"><?php echo $ver['time']; ?></td>
    <td align="center" bgcolor="<?php echo $background ?>"><?php echo $ver['id_mesa'] ?></td>
    <td bgcolor="<?php echo $background ?>"><?php echo $ver['nomeGarcon'] ?></td>
    <td align="center" bgcolor="<?php echo $background ?>">
    <a href="?btn=garcon&acao=mudar&id=<?php echo $ver['id']; ?>"><img src="imagens/ok.png" width="20" height="20" boder="0" tittle="Marcar como entregue" /></a></td>
  </tr>
  <?php } ?>
  </table>



</div>
</div>
</body>
</html>