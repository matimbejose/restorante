
<?php

include "config/conexao.php"; 
 if($_GET['btn'] =="cancela"){
		$num = $_GET['numero'];
		$del = mysql_query("DELETE FROM tbl_carrinho WHERE comanda = '$num' ") or die(mysql_error());
		if($sql == 1){
	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=nova'>";

	}

  }else{
?>


<table width="100%" border="0" class="inputs">
  <tr>
  <?php 
  $comand = $_GET['comanda'];
  $sql = mysql_query("SELECT * FROM tbl_carrinho WHERE comanda='$comand'") or die(mysql_error());
  $cont = mysql_fetch_array($sql);
  $numero = $cont['comanda'];

  ?>
  <td align="center"><strong>Pedido nº: <?php echo $numero ?></strong></td>
  </tr>
  <tr>
    <td align="center">Beirut - Food Service <br/> Anicuns - <?php echo date("d/m/Y"); ?></td>
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
		echo "";
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
    </tr>
     <?php 
		}
	}	
	?>   
    </table>
 <div id="formulario">
 <script type="text/javascript"  src="js/jquery-1.8.2.min.js"></script>
 <script type="text/javascript"  src="js/jquery.mask-money.js"></script>
 
<script type="text/javascript">
function operacao(){
a = document.formulario.troco.value = document.formulario.dinheiro.value - document.formulario.total.value;
document.formulario.troco.value = number_format(a, 2, ',', '.');

}
function number_format( number, decimals, dec_point, thousands_sep ) {
	var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	var d = dec_point == undefined ? "," : dec_point;
	var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
	var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

$(document).ready(function() {
	$("input.calc").maskMoney({decimal:".",thousands:"."});  
        $(".real").maskMoney({decimal:".",thousands:"."});
		
      });

var win = null;
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
}
</script>
     <?php $total = number_format($total, 2, '.', '.'); ?>
<form name="formulario" action="" method="post" enctype="multipart/form-data">
            <input name="numero" type="hidden" value="<?php echo $numero ?>" />
            <span class="valores">Total </span>
            <input name="total" type="text" value="<?php echo $total ?>" size="8" class="calc" /><br/>
    <span class="valores">Dinheiro: </span>
<input name="dinheiro" type="text" size="8"  class="calc" onkeyup="javascript:operacao('')" id="dinheiro-1"/><br/>
            <span class="valores">Troco: </span>
            <input name="troco" type="text" class="calc" size="8" maxlength="8" readonly="true"/><br/>
            </form><br/>
            <a href="?btn=cancela&numero=<?php echo $numero;?>" class="button">Cancela Pedido</a>
  <a href="imprime.php?numero=<?php echo $numero;?>" 
  onclick="NovaJanela(this.href,'nomeJanela','350','600','yes');return false" class="button">
  Imprimir Pedido</a>
</div>
<?php } ?>