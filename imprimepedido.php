<?php require_once('Connections/sistema.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_mesa'])) {
  $colname_Recordset1 = $_GET['id_mesa'];
}
mysql_select_db($database_sistema, $sistema);
$query_Recordset1 = sprintf("SELECT * FROM pedido WHERE id_mesa = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $sistema) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
include "config/conexao.php";

$sql = mysql_query("SELECT * FROM config");
$ver = mysql_fetch_array($sql);
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fechamento de mesa</title>
<script> 
 <?php  
 $id_mesa = $_GET['id_mesa'];
  ?> 
function confirma() {  
   if (confirm("Tem certeza que est?? conta j?? foi paga?")) {  
   	  window.close();
      window.opener.location.href="inicio2.php?btn=entrega&fecha=fechar&id_mesa=<?php echo $id_mesa;?>"; 
	   
   }  
}
</script>  
<style type="text/css">
body,td,th {
	font-family: "Courier New", Courier, monospace; font-size:12px;
}
.titulo{font-size:16px;}
hr{ color:#f2f2f2;}
</style>
</head>

<body>
<table width="340" border="0" align="center" class="inputs">
  <tr>
  <?php 
  
 $id_mesa = $_GET['id_mesa'];
 $pgarcon = $_GET['pgarcon'];
 $somatotal = $_GET['somatotal'];
 $rua = $_GET['rua'];
  ?>
  <td align="center"><strong><span class="titulo">Nome: <?php echo $row_Recordset1['nome']; ?> <?php echo $row_Recordset1['sobrenome']; ?></span></strong></td>
  </tr>
  <tr>
    <td align="center"><?php echo $ver['empresa']?> <br/>   data - <?php echo date("d/m/y") ?></td>
  </tr>
    <tr>
    <td><hr/></td>
    </tr>
  </tr>
</table>
<table width="340" align="center">
    <tr>
	  <td><strong>Produtos</strong></td>
      <td width="18%" align="center"><strong>QDT</strong></td>
	  <td align="center"><strong>VL UN</strong></td>
	  <td align="center"><strong>VALOR</strong></td>
  </tr>
	<?php	
	$carrinho = mysql_query("SELECT *, SUM(qtd) AS qt, SUM(preco) AS pr FROM entrega WHERE id_mesa = '$id_mesa' AND situacao='1' GROUP BY cod") or die(mysql_error());
	$contar = mysql_num_rows($carrinho);
	
	if($contar == 0){
		echo "Adicione itens";
	}else{		
		while($res = mysql_fetch_array($carrinho)){		
		
			$id           	= $res['id'];
			$cod     	  	= $res['cod'];
			$nome  			= $res['nome'];
			$preco       	= $res['pr'];	
			$qtd		 	= $res['qt'];
			$unitario		= $res['preco'];
			$comanda		= $res['comanda'];
			$data			= $res['data'];
			$itens			+=$qtd;
			$total += $preco;
	?>
	<tr class="fontcomanda">
    <td width="53%" align="left" class="btn"><?php echo $nome; ?> </td>
    <td align="center" ><?php echo $qtd; ?> </td>
    <td width="15%" align="right"><?php echo $unitario ?></td>
    <td width="14%" align="right"><?php echo number_format($preco, 2, '.', '.'); ?></td>
     <?php 
		}
	}	
	?>
    </tr>
	<tr class="fontcomanda">
	  <td colspan="4" align="right" class="btn"><hr/></td>
  </tr>
	<tr class="fontcomanda">
	  <td colspan="3" align="right" class="btn"><strong>Total de Itens:</strong></td>
	  <td align="right"><strong><?php echo $itens; ?></strong></td>
  </tr>
	<tr class="fontcomanda">
	  <td colspan="3" align="right" class="btn"><strong>Valor total:</strong></td>
	  <?php $totals = number_format($total, 2, ',', '.'); ?>
	  <td align="right"><strong><?php echo $totals ?></strong></td>
  </tr>
	<tr class="fontcomanda">
	  <td colspan="3" align="right" class="btn"><strong>Gar??om:</strong></td>
	  <td align="right"><?php echo number_format($pgarcon,2, ',', '.') ?></td>
  </tr>
	<tr class="fontcomanda">
	  <td colspan="3" align="right" class="btn"><strong>Total:</strong></td>
      
	  <td align="right"><?php echo number_format($somatotal, 2, ',', '.') ?></td>
  </tr>
  
  <tr class="fontcomanda">
	  <td colspan="4" align="left" class="btn"><strong>Telefone: </strong><?php echo  $row_Recordset1['telefone']; ?><br /><strong>Bairro: </strong><?php echo $row_Recordset1['bairro']; ?><br />
 <strong>Rua: </strong><?php echo $row_Recordset1['rua']; ?><br />
 <strong>Numero: </strong><?php echo $row_Recordset1['numerocasa']; ?><br />
 <strong>Detalhes:</strong> <?php echo $row_Recordset1['detalhes']; ?></td>
  </tr>  
	<tr class="fontcomanda">
	  <td colspan="4" align="center" class="btn"><br/>
<input name="" type="button" value="Fechar pedido" onclick="confirma();" />
<input name="" type="button" value="Imprimir conta" onclick="window.print();" /></td>
  </tr>   
</table>
 <br/>
<br/>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
