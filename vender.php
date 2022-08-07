<?php 
date_default_timezone_set('America/Sao_Paulo'); 
  $sql1 = mysql_query("SELECT * FROM tbl_carrinho ORDER BY comanda DESC") or die(mysql_error());
  $cont1 = mysql_fetch_array($sql1);
  $numero1 = $cont1['comanda'];
  $proxima1 = $numero1 + 1;
 	
	if($proxima1 >= 1000){
		print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=nova'>";
		$muda = mysql_query("UPDATE tbl_carrinho SET comanda ='0'") or die(mysql_error());
	}
	
  ?>
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
			
				$.post('atualiza.php?comanda=<?php echo $proxima1 ?>', function(atualiza_comentarios){			
				$("#comentarios").html(atualiza_comentarios);
				});
		return false;
            },
		});
        });    
    });
////////////////////////////////////////////////////


</script>
<?php 
 /* $sql1 = mysql_query("SELECT * FROM tbl_carrinho ORDER BY comanda DESC") or die(mysql_error());
  $cont1 = mysql_fetch_array($sql1);
  $numero1 = $cont1['comanda'];
  $proxima1 = $numero1 + 1;
  */
  ?>
<h1>Comanda de venda nº: <?php echo $proxima1 ?></h1>

<div id="boxprodutos">
	<div id="comentarios2">
    <ul>
	<?php	
	$idCategoria = $_GET['id_categoria'];
	$seleciona = mysql_query("SELECT * FROM tbl_produtos WHERE id_categoria ='6' ORDER BY nome ASC") or die(mysql_error());
	$contar = mysql_num_rows($seleciona);
	
	if($contar == 0){
		echo "";
	}else{		
		while($res_comentarios = mysql_fetch_array($seleciona)){		
		
			$cod          = $res_comentarios['cod'];
			$nome         = $res_comentarios['nome'];
			$preco		  = $res_comentarios['preco'];
			$data         = $res_comentarios['data'];	
	?>
       <li><a href="cadastra.php?cod=<?php echo $cod ?>&nome=<?php echo $nome ?>&preco=<?php echo $preco ?>&qtd=1&comanda=<?php echo $proxima1 ?>" class="btn"><?php echo $nome; ?></a></li> 
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
  <?php 
  
  $sql = mysql_query("SELECT * FROM tbl_carrinho WHERE comanda ='$proxima1'") or die(mysql_error());
  $cont = mysql_fetch_array($sql);
  $numero = $cont['comanda'];
  $proxima = $munero + 1;
  ?>
  <td align="center"><strong>Pedido nº: <?php echo $proxima1 ?></strong></td>
  </tr>
  <tr>
   <?php $n = mysql_query("SELECT * FROM config");
 	$a = mysql_fetch_array($n);
 ?>
    <td align="center"><?php echo $a['empresa'] ?> <br/> <?php echo date("d/m/Y"); ?></td>
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
	$carrinho = mysql_query("SELECT * FROM tbl_carrinho WHERE comanda='$proxima1'") or die(mysql_error());
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
    </tr>
     <?php 
		}
	}	
	?>   
    </table>   
 <div id="formulario">
    <?php $total = number_format($total, 2, '.', '.'); ?>
      <form name="formulario" action="" method="post" enctype="multipart/form-data">
            <span class="valores">Total </span>
        <input name="total" type="text" value="<?php echo $total ?>" size="8" maxlength="6" class="calc" readonly="true"/><br/>
            <span class="valores">Dinheiro: </span>
    <input name="dinheiro" type="text" size="8" maxlength="6"  class="calc" onkeyup="javascript:operacao('')" id="dinheiro-1" readonly="true"/><br/>
            <span class="valores">Troco: </span>
        <input name="troco" type="text" class="calc" size="8" maxlength="8" readonly="true"/><br/>
            
      </form> 
      <a href="inicio.php"class="button">
  Cancelar pedido</a>   
      </div>
  </div><!--// fecha comentários --> 
</div><!--// fecha box -->
<div style="clear:both;"></div>




