<?php
include "config/conexao.php";

$sql = mysql_query("SELECT * FROM config");
$ver = mysql_fetch_array($sql);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comanda</title>

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
  
 $numero = $_GET['numero'];
  ?>
  <td align="center"><strong><span class="titulo">Pedido nº: <?php echo $numero ?></span></strong></td>
  </tr>
  <tr>
    <td align="center"><?php echo $ver['empresa']?> <br/> Anicuns - <?php echo date("d/m/Y"); ?></td>
  </tr>
    <tr>
    <td><hr/></td>
    </tr>
  </tr>
</table>
<table width="100%">
    <tr>
	  <td><strong>Produtos</strong></td>
      <td width="14%" align="center"><strong>QDT</strong></td>
	  <td align="center"><strong>Preço</strong></td>
	  </tr>
	<?php	
	$carrinho = mysql_query("SELECT * FROM tbl_carrinho WHERE comanda = '$numero'") or die(mysql_error());
	$contar = mysql_num_rows($carrinho);
	
	if($contar == 0){
		echo "Adicione itens";
	}else{		
		while($res = mysql_fetch_array($carrinho)){		
		
			$id           	= $res['id'];
			$cod     	  	= $res['cod'];
			$nome  			= $res['nome'];
			$preco       	= $res['preco'];	
			$qtd		 	= $res['qtd'];
			$comanda		= $res['comanda'];
			$data			= $res['data'];
			
			$total += $preco * $qtd;
	?>
	<tr class="fontcomanda">
    <td width="67%" align="left" class="btn"><?php echo $nome; ?> </td>
    <td align="center" ><?php echo $qtd; ?> </td>
    <td width="19%" align="right"><?php echo $preco; ?></td>
     <?php 
		}
	}	
	?>
    </tr>
	<tr class="fontcomanda">
	  <td align="left" class="btn">&nbsp;</td>
	  <td align="center" ><strong>Total </strong></td>
      <?php $totals = number_format($total, 2, ',', '.'); ?>
	  <td align="right"><strong><?php echo $totals ?></strong></td>
  </tr>
	<tr class="fontcomanda">
    <?php //$handle = printer_open("CutePDF Writer");?>
	  <td colspan="3" align="center" class="btn"></td>
  </tr>   
    </table>
 <br/>
<hr />
<br/>
    <table width="100%" border="0" class="inputs">
  <tr>
  <?php 
  
 $numero = $_GET['numero'];
  ?>
  <td align="center"><strong><span class="titulo">Pedido nº: <?php echo $numero ?></span></strong></td>
  </tr>
  <tr>
    <td align="center"><?php echo $ver['empresa']?> <br/> Anicuns - <?php echo date("d/m/Y"); ?></td>
  </tr>
    <tr>
    <td><hr/></td>
    </tr>
  </tr>
</table>
	
<table width="100%">
    <tr>
	  <td><strong>Produtos</strong></td>
      <td width="14%" align="center"><strong>QDT</strong></td>
	  <td align="center"><strong>Preço</strong></td>
	  </tr>
	<?php	
	$carrinho2 = mysql_query("SELECT * FROM tbl_carrinho WHERE comanda = '$numero'") or die(mysql_error());
	$contar2 = mysql_num_rows($carrinho2);
	
	if($contar2 == 0){
		echo "Adicione itens";
	}else{		
		while($res2 = mysql_fetch_array($carrinho2)){		
		
			$id2           	= $res2['id'];
			$cod2     	  	= $res2['cod'];
			$nome2  		= $res2['nome'];
			$preco2       	= $res2['preco'];	
			$qtd2		 	= $res2['qtd'];
			$comanda2		= $res2['comanda'];
			$data2			= $res2['data'];
			
			$total2 += $preco2 * $qtd2;
	?>
	<tr class="fontcomanda">
    <td width="67%" align="left" class="btn"><?php echo $nome2; ?> </td>
    <td align="center" ><?php echo $qtd2; ?> </td>
    
    <td width="19%" align="right"><?php echo $preco2; ?></td>
     <?php 
		}
	}	
	?>
    </tr>
	<tr class="fontcomanda">
	  <td align="left" class="btn">&nbsp;</td>
	  <td align="center" ><strong>Total </strong></td>
      <?php $total2 = number_format($total2, 2, ',', '.'); ?>
	  <td align="right"><strong><?php echo $total2 ?></strong></td>
  </tr>
	<tr class="fontcomanda">
    <?php //$handle = printer_open("CutePDF Writer");?>
	  <td colspan="3" align="center" class="btn"><a href="#" onclick="window.print(); window.opener.location.href='inicio.php?btn=nova'; 
window.close();"><img src="imagens/icon_imprime.jpg" width="60" height="60" border="0" /></a></td>
  </tr>   
    </table>
</body>
</html>