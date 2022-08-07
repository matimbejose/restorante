<?php date_default_timezone_set('America/Sao_Paulo'); ?>

<script type="text/javascript">
            function imprimir(){
                var pagina = document.getElementById("buscacomanda").innerHTML;
                var novaJanela = window.open('','_blank',		'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
                novaJanela.document.write("<head>");
				novaJanela.document.write("<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' />");
				novaJanela.document.write("<style tyle='text/css' media='print'>button{display: none;}</style>");
				novaJanela.document.write("<style tyle='text/css' media='all'>a{color: #0000FF;}</style>");
				novaJanela.document.write("</head>");
                novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir Página</button>");
				novaJanela.document.write("<h3></h3>");
				novaJanela.document.write(pagina);

            }
			
////////////////////// MASCARA DE IMPUTS /////////////////////////
	jQuery(function($){
   $("#hora1").mask("99:99");
   $("#hora2").mask("99:99");
});
function validar() {
var datai = form.datai.value;
var dataf = form.dataf.value;
var hora1 = form.hora1.value;
var hora2 = form.hora2.value;
 
if (datai == "") {
alert('Escolha a data inicial');
form.datai.focus();
return false;
}

if (dataf == "") {
alert('Escolha a data final');
form.dataf.focus();
return false;
}
if (hora1 == "") {
alert('Digite a hora inicial');
form.hora1.focus();
return false;
}
if (hora2 == "") {
alert('Digite a hora final');
form.hora2.focus();
return false;
}

} ////////////// FIM DA FUNCTION /////////////////////
        </script>
<div class="naomostra">
<form action="?btn=relatorio&busca=data" method="post" enctype="multipart/form-data" id="form">

	Data Início: <input name="datai" type="text" size="12" id="datai">
    Data Final: <input name="dataf" type="text" size="12" id="dataf">
     Entre:<input name="hora1" type="text" size="3" maxlength="5" id="hora1"/>Hrs e <input name="hora2" type="text" size="3" maxlength="5" id="hora2"/>
  <input name="buscar" type="submit" value="Buscar" id="buscar" onclick="return validar()">
</form>
</div>
<br/>
<div id="buscacomanda">

  <table width="95%" align="center" cellpadding="3" cellspacing="0" style="margin-top:5px; border:1px solid #f2f2f2; font-size:13px;">	
	<tr style="border:1px solid #f2f2f2;">
    <td width="15%" align="center" bgcolor="#66CCFF"  style="border:1px solid #CCC;"><strong>Data</strong></td>
    <td width="40%" align="center" bgcolor="#66CCFF" style="border:1px solid #CCC;"><strong>Produto</strong></td>
    <td width="7%" align="center" bgcolor="#66CCFF" style="border:1px solid #CCC;"><strong>QTD.</strong></td>
    <td width="19%" align="center" bgcolor="#66CCFF" style="border:1px solid #CCC;"><strong>Preço un</strong></td>
    <td width="19%" align="center" bgcolor="#66CCFF" style="border:1px solid #CCC;"><strong>Preço total</strong></td>
  </tr>
	
	
	<?php
	if($_GET['busca'] == "data"){
			$datai = date('Y/m/d', strtotime($_POST['datai']));
			$dataf = date('Y/m/d', strtotime($_POST['dataf']));
			$hora1 = $_POST['hora1'];
			$hora2 = $_POST['hora2'];
	$query = mysql_query("SELECT data, nome, preco, SUM(preco) AS pr, SUM(qtd) AS qtd, date_format(data, '%d/%m/%Y') AS data FROM tbl_carrinho WHERE data BETWEEN '$datai' AND '$dataf' AND time BETWEEN '$hora1' AND '$hora2' GROUP BY nome") or die(mysql_error());

		while($resultado = mysql_fetch_array($query)){
			$data = $resultado['data'];
			$nome = $resultado['nome'];
			$qtd = $resultado['qtd'];
			$preco_unitario = $resultado['preco'];
			$precototal = $resultado['pr'];	
			$total_produto = $qtd * $preco_unitario;
			$total += $total_produto; 
			?>
  <tr style="border:1px solid #f2f2f2;">
    <td align="center" style="border:1px solid #f2f2f2;"><?php echo $data ?></td>
    <td align="left" style="border:1px solid #f2f2f2;"><?php echo $nome ?></td>
    <td align="center" style="border:1px solid #f2f2f2;"><?php echo $qtd ?></td>
    <td align="center" style="border:1px solid #f2f2f2;"><?php echo str_replace(".",",",$preco_unitario);  ?></td>
    <td align="right" style="border:1px solid #f2f2f2;"><?php echo str_replace(".",",",$total_produto); ?></td>
  </tr>
    
    
    <?php }  ?>
     <tr>
    <td colspan="3" align="center">&nbsp;</td>
    <td align="center" style="border:1px solid #f2f2f2;"><strong>Total do período</strong></td>
    <td align="right" style="border:1px solid #f2f2f2;"><strong><?php echo number_format($total, 2, ',', '.'); ?></strong></td>
  </tr>

 <?php } ?>
</table>




</div> 
<div style="text-align:center; margin-top:5px;"><button type="button" onclick="javascript:imprimir();">Imprimir relatório</button></div>        
</div>