<?php

date_default_timezone_set('America/Sao_Paulo');

$numero = $_GET['id_mesa'];

if($_GET['retira'] == "produto"){

	$numer = $_GET['numero'];

	$mesaId = $_GET['id_mesa'];

	$idDelete = $_GET['id'];

	$del = mysqli_query($connect,"DELETE FROM	tbl_carrinho WHERE id='$idDelete'");

	if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=vendermesa&id_mesa=$mesaId'>";	

	}

}



if(isset($_POST['ok'])){

		

		$idGarcon = $_POST['nomeGarcon'];

		

		$altera = mysqli_query($connect,"UPDATE mesa SET idGarcon = '$idGarcon', situacao = '1' WHERE id_mesa = '$numero' ") or die(mysql_error());

		if($altera == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=vendermesa&id_mesa=$numero&idGarcon=$idGarcon'>";	

	}

}



?>

<?php 

	

  $sql1 = mysqli_query($connect,"SELECT * FROM mesa WHERE numero='$numero'") or die(mysql_error());

  $cont1 = mysqli_fetch_array($sql1);

  $sit = $cont1['situacao'];

$idGarconget = $_GET['idGarcon'];

$gar2 = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon='$idGarconget'");

$h2 = mysqli_fetch_array($gar2);

  ?>

<h1>



<form action="" method="post" enctype="multipart/form-data">

Mesa nº: <?php echo $numero ?>&nbsp-&nbsp;

Garçom Responsável: <select name="nomeGarcon">

<option value="0">=Selecione=</option>

<?php 

	$gar = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon != '1' ORDER BY nomeGarcon ASC") or die(mysql_error());

	while($h = mysqli_fetch_array($gar)){

		

?>

  <option value="<?php echo $h['idGarcon'] ?>"<?php if (!(strcmp($h['idGarcon'], $h2['idGarcon']))) {echo "selected=\"selected\"";} ?>><?php echo $h['nomeGarcon'] ?></option>

		

	<?php }?>



</select>

<?php if($sit == "0"){?>

<input name="ok" type="submit" value="Abrir mesa" style="background-color: #F30; border:1px solid #9B0000;" />

<?php }else{ ?>

<input name="ok" type="submit" value="Alterar" style=" background-color:#090; border:1px solid #030;" />

<?php } ?>

</form>





</h1>



<div id="boxprodutos"><br/>

<?php if($sit == "1"){

include "selecionacat.php";

} ?>

	<div id="comentarios2">

    <ul>

	<?php	

	$idCategoria = $_GET['id_categoria'];

	$seleciona = mysqli_query($connect,"SELECT * FROM tbl_produtos WHERE id_categoria = '$idCategoria' ORDER BY nome ASC") or die(mysql_error());

	$contar = mysqli_num_rows($seleciona);

	

	if($contar == 0){

		echo "";

	}else{		

		while($res_comentarios = mysql_fetch_array($seleciona)){		

		

			$cod          = $res_comentarios['cod'];

			$nome         = $res_comentarios['nome'];

			$preco		= $res_comentarios['preco'];

			$data         = $res_comentarios['data'];

			$destino      = $res_comentarios['destino'];

				

	?>

<li><a href="cadastra.php?cod=<?php echo $cod ?>&nome=<?php echo $nome ?>&preco=<?php echo $preco ?>&qtd=1&mesa=<?php echo $numero ?>&idGarcon=<?php echo $idGarcon; ?>&destino=<?php echo $destino ?>" class="btn"><?php echo $nome; ?></a>

</li> 

    <?php 

		}

	}	

	?>    

    </ul>    

    </div><!--// fecha comentários --> 

</div><!--// fecha box -->

<div id="box">

	<div id="comentarios">

    <table width="100%" border="0" class="inputs">

  <tr>

 <?php $n = mysqli_query($connect,"SELECT * FROM config");

 	$a = mysqli_fetch_array($n);

 ?>

  <td align="center" style="font-size:16px;"><strong>Mesa nº: <?php echo $numero ?></strong></td>

  </tr>

  <tr>

    <td align="center" style="font-size:16px;"><?php echo $a['empresa'] ?><br/> <?php echo date("d/m/y") ?></td>

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

    <tr>

	  <td  style="font-size:16px;"><strong>Produtos</strong></td>

      <td width="13%" align="center" style="font-size:16px;"><strong>QDT</strong></td>

      <td width="15%" align="center" style="font-size:16px;"><strong>UN</strong></td>

	  <td align="center" style="font-size:16px;"><strong>TOTAL</strong></td>

	  <td align="center">&nbsp;</td>

	  </tr>

	<?php	

	

	$carrinho = mysqli_query($connect,"SELECT *, SUM(qtd) AS qt,SUM(preco) AS pr FROM tbl_carrinho WHERE id_mesa='$numero' AND situacao='1' GROUP BY cod") or die(		mysql_error());

	$contar = mysqli_num_rows($carrinho);

	

	if($contar == 0){

		echo "";

	}else{		

		while($res = mysqli_fetch_array($carrinho)){		

		

			$id           	= $res['id'];

			$cod     	  	= $res['cod'];

			$nome  			= $res['nome'];

			$preco       	= $res['pr'];	

			$qtd		 	= $res['qt'];

			$unitario		= $res['preco'];

			$comanda		= $res['comanda'];

			$data			= $res['data'];

			$id_mesa		= $res['id_mesa'];

			

			$itens +=$qtd;

			$total += $preco;

	?>

	<tr class="fontcomanda">

    <td width="60%" align="left">

    <a href="cozinha.php?id_mesa=<?php echo $id_mesa ?>&nome=<?php echo $nome; ?>"  title="Imprimir"

    onclick="Cozinha(this.href,'nomeJanela','350','600','yes');return false" class="fontcomanda"><?php echo $nome; ?></a>

    </td>

    <td align="center" ><?php echo $qtd; ?> </td>

    <td align="center" ><?php echo  str_replace(".",",",$unitario); ?></td>

    <td width="10%" align="right"><?php echo number_format($preco, 2, ',', '.'); ?></td>

    <td width="2%" align="right">

    <a href="inicio.php?btn=vendermesa&retira=produto&id=<?php echo $id ?>&id_mesa=<?php echo $numero ?>"><img src="imagens/icone_delete.gif" width="17" height="18" border="0" /></a>

    </td>

    </tr>

     <?php 

		}

	}	

	?> 

	<tr class="fontcomanda">

	  <td colspan="3" align="right">Total de Itens:</td>

	  <td align="right"><?php echo $itens ?></td>

	  <td align="right">&nbsp;</td>

	  </tr>

      

    </table>   

 <div id="formulario">

 <script type="text/javascript"  src="js/jquery-1.8.2.min.js"></script>

 <script type="text/javascript"  src="js/jquery.mask-money.js"></script>

<script type="text/javascript">

// JavaScript Document

$(document).ready(function(){

    $(".btn").click(function(event) {

       event.preventDefault();

        $.ajax({

        //pegando a url apartir do href do link

            url: $(this).attr("href"),

            type: 'GET',

            context: jQuery('#resultado'),

            success: function(res_cadastra){			

				

				$(".inputs").html(res_cadastra);

			

				$.post('atualizamesa.php?id_mesa=<?php echo $_GET['id_mesa']; ?>', function(atualiza_comentarios){			

				$("#comentarios").html(atualiza_comentarios);

				});

		return false;

            },

		});

        });    

    });

	

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

		

      });



var win = null;

function NovaJanela(pagina,nome,w,h,scroll){

	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'

	win = window.open(pagina,nome,settings);

}



</script>

    <?php $totals = number_format($total, 2, ',', '.'); ?>

<form name="formulario" action="" method="post" enctype="multipart/form-data">

            <span class="valores">Total venda </span>

        <input name="total" type="text" value="<?php echo $totals ?>" size="8" maxlength="6" class="calc" readonly="true"/><br/>

        	<?php 

					

			$g = mysqli_query($connect,"SELECT * FROM config") or die(mysql_error());

			$w = mysqli_fetch_array($g);

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

            

      </form> 

      <br/>

      <?php 

	  $mesas = $_GET['id_mesa'];

	  ?>

      <a href="imprimemesa.php?id_mesa=<?php echo $mesas;?>&pgarcon=<?php echo $pgarcon?>&somatotal=<?php echo $somatotal ?>" 

  onclick="NovaJanela(this.href,'nomeJanela','750','600','yes');return false" class="button">

  Fechar Conta</a> 

      </div>

  </div><!--// fecha comentários --> 

</div><!--// fecha box -->

<div style="clear:both;"></div>









