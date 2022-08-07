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
date_default_timezone_set('America/Sao_Paulo');
 if($_GET['btn'] =="cancela"){
	 	$mesa = $_GET['id_mesa'];
		$num = $_GET['numero'];
		$del = mysql_query("DELETE FROM entrega WHERE id_mesa = '$mesa' ") or die(mysql_error());
		if($sql == 1){
	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio2.php?btn=vendapedido'>";

	}

  }
  if($_GET['retira'] == "produto"){
	$mesaId = $_GET['id_mesa'];
	$idDelete = $_GET['id'];
	$del = mysql_query("DELETE FROM entrega WHERE id='$idDelete'");
	if($del == 1){
	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio2.php?btn=vendapedido&id_mesa=$mesaId'>";	
	}
}
  
else{
?>
<table width="100%" border="0" class="inputs">
  <tr>
  <?php 
  $mesa = $_GET['id_mesa'];
  $sql = mysql_query("SELECT * FROM entrega WHERE id_mesa = '$mesa'") or die(mysql_error());
  $cont = mysql_fetch_array($sql);
  $id_mesa = $cont['id_mesa'];
  
    $n = mysql_query("SELECT * FROM config");
 	$a = mysql_fetch_array($n);
 ?>
  <td align="center" style="font-size:16px;"><strong>Nome do cliente: <?php echo $row_Recordset1['nome']; ?></strong></td>
  </tr>
  <tr>
    <td align="center" style="font-size:16px;"><?php echo $a['empresa'] ?> <br/> <?php echo date("d/m/Y"); ?></td>
    </tr>
    <tr>
    <td><hr/></td>
    </tr>
  </tr>
</table>
<script type="text/javascript">
var win = null;
function Cozinha(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/3 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/3 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
}

</script>	
<table width="100%">
    <tr style="font-size:16px;">
	  <td width="60%" style="font-size:16px;"><strong>Produtos</strong></td>
	  <td width="13%" align="center"style="font-size:16px;"><strong>QDT</strong></td>
	  <td width="15%" align="center"style="font-size:16px;">UN</td>
	  <td align="center" style="font-size:16px;"><strong>Preço</strong></td>
	  <td align="center">&nbsp;</td>
	  </tr>
      
	<?php
		
	$mesa = $_GET['mesa'];
	$carrinho = mysql_query("SELECT *, SUM(qtd) AS qt,SUM(preco) AS pr FROM entrega WHERE id_mesa = '$id_mesa' AND situacao ='1' GROUP BY cod") or die(mysql_error());
	$contar = mysql_num_rows($carrinho);
	
	if($contar == 0){
		echo "";
	}else{		
		while($res = mysql_fetch_array($carrinho)){		
		
			$id           	= $res['id'];
			$cod     	  	= $res['cod'];
			$nome  			= $res['nome'];
			$preco       	= $res['pr'];
			$unitario		= $res['preco'];	
			$qtd		 	= $res['qt'];
			$comanda		= $res['comanda'];
			$data			= $res['data'];
			$id_mesa		= $res['id_mesa'];
			$itens			+=$qtd;
			$total += $preco;
	?>
	<tr class="fontcomanda">
    <td align="left" class="btn">
      <a href="cozinha.php?id_mesa=<?php echo $id_mesa ?>&nome=<?php echo $nome; ?>"  title="Imprimir" onclick="Cozinha(this.href,'nomeJanela','350','600','yes');return false" class="fontcomanda"><?php echo $nome; ?></a></td>
    
    <td align="center" ><?php echo $qtd; ?> </td>
    <td align="center" ><?php echo $unitario ?></td>
    <td width="13%" align="right"><?php echo number_format($preco, 2); ?></td>
    <td width="6%" align="right">
    <a href="inicio2.php?btn=vendapedido&retira=produto&id=<?php echo $id ?>&id_mesa=<?php echo $id_mesa ?>"><img src="imagens/icone_delete.gif" width="17" height="18" border="0" /></a>
    </td>
    </tr>
	
     <?php 
		}
	}	
	?>  
     <tr class="fontcomanda">
	  <td colspan="3" align="right" class="btn">Total de itens:</td>
	  <td align="right"><?php echo $itens ?></td>
	  <td align="right">&nbsp;</td>
  </tr>
    </table>
 <div id="formulario">
 <script type="text/javascript"  src="js/jquery-1.8.2.min.js"></script>
 <script type="text/javascript"  src="js/jquery.mask-money.js"></script>
<script type="text/javascript">

/////////////////////// RESOLVENDO PROBLEMA COM MOEDAS E SOMAS /////////////////////////////
    function formatReal( int )
    {
    var tmp = int+'';
    var neg = false;
    if(tmp.indexOf("-") == 0)
    {
    neg = true;
    tmp = tmp.replace("-","");
    }
    if(tmp.length == 1) tmp = "0"+tmp
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
    if( tmp.length > 6)
    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    if( tmp.length > 9)
    tmp = tmp.replace(/([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g,".$1.$2,$3");
    if( tmp.length > 12)
    tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g,".$1.$2.$3,$4");
    if(tmp.indexOf(".") == 0) tmp = tmp.replace(".","");
    if(tmp.indexOf(",") == 0) tmp = tmp.replace(",","0,");
    return (neg ? '-'+tmp : tmp);
    }

function operacao(){
str = document.formulario.dinheiro.value;
nvdinheiro = str.replace(",", "");
d = nvdinheiro.replace(".","");

str2 = document.formulario.somatotal.value;
nvsomatotal = str2.replace(",", "");
t = nvsomatotal.replace(".","")
a = d - t;
document.formulario.troco.value = formatReal(a);
}

///////////////////// FIM DO PROBLEMA //////////////////////////////////////////////////

$(document).ready(function() {
	$("input.calc").maskMoney({decimal:",",thousands:"."});  
        $(".real").maskMoney({decimal:",",thousands:"."});
		
      });

var win = null;
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/3 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/3 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
}
</script>
     <?php $totals = number_format($total, 2, ',', '.'); ?>
     <form name="formulario" action="" method="post" enctype="multipart/form-data">
            <span class="valores">Total venda </span>
        <input name="total" type="text" value="<?php echo $totals ?>" size="8" maxlength="6" class="calc" readonly="true"/><br/>
        	<?php 
					
			$g = mysql_query("SELECT * FROM config") or die(mysql_error());
			$w = mysql_fetch_array($g);
			$ativo = $w['ativo'];
			$percentual = $w['pgarcon'];
			if($ativo == 1){
			$porcento_garcon = $percentual;
			}else{
			$porcento_garcon = 0;
			}
				
				$pgarcon = $total * $porcento_garcon / 100;
				
				$somatotal = $total + $pgarcon;
			
			?>
                <span class="valores">Percentural do Garçon </span>
                <input name="garconP" type="text" class="calc" id="garconP" value="<?php echo number_format($pgarcon, 2, ',', '.'); ?>"/><br/>
                <span class="valores">Total </span>
             <input name="somatotal" type="text" class="calc" id="somatotal" value="<?php echo number_format($somatotal, 2, ',', '.'); ?>"/><br/>
                
        <span class="valores">Dinheiro </span>
        <input name="dinheiro" type="text" size="8"  class="calc" onkeyup="javascript:operacao('')" id="dinheiro-1"/><br/>
            <span class="valores">Troco </span>
            <input name="troco" type="text" class="calc" size="8" maxlength="8" readonly="true"/><br/>
            
   </form> <br/>
   <?php $mesas = $_GET['id_mesa'];?>
      <a href="imprimepedido.php?id_mesa=<?php echo $mesas;?>&pgarcon=<?php echo $pgarcon?>&somatotal=<?php echo $somatotal ?>" 
  onclick="NovaJanela(this.href,'nomeJanela','750','600','yes');return false" class="button">
  Fechar Conta</a>

</div>
<?php } 
mysql_free_result($Recordset1);
?>