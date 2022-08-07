<h1>Cadastro de produtos</h1><br/>
<?php

include "config/conexao.php";

if(isset($_POST['cadastrar'])){
	
	$nome 	= $_POST['nome'];
	$precov 	=  str_replace(".", "",$_POST['preco']);
	$preco = str_replace(",", ".",$precov);
	$img	= $_POST[''];
	$categoria = $_POST['categoria'];
	$destino = $_POST['destino'];
	
	if($categoria == ""){
	print "
	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadastroProdutos'>
	<script type=\"text/javascript\">
	alert(\"ERRO!! Selecione uma categoría para o produto.\");
	</script>";	
	}else{	
	
	
	
	$sql = mysql_query("INSERT INTO tbl_produtos(nome, preco, img, id_categoria,destino)VALUES('$nome','$preco','$img','$categoria','$destino')") or die(mysql_error());	
	
	if($sql == 1){
	print "
	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadastroProdutos'>
	<script type=\"text/javascript\">
	alert(\"Cadastrado com sucesso.\");
	</script>";	
	}
	
}
}
?>
 <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
 <script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $("#preco").maskMoney({decimal:",",thousands:"."});
		
      });
</script>
<div id="boxcadProdutos2">
	<div id="form">
    
	<form action="" name="form" method="post" enctype="multipart/form-data">
    	<span class="nomeform">Nome do Produto:</span><br/>
  <input name="nome" type="text" class="form2" size="35" maxlength="35" id="nome"><br/><br/>
  	<span class="nomeform">Categoria:</span><br/>
  	<select name="categoria" class="form2">
    <option value="">== Selecione ==</option>
    <?php 
		$cat = mysql_query("SELECT * FROM categoria ORDER BY nome ASC");
		while($c = mysql_fetch_array($cat)){
	?>
  	  <option value="<?php echo $c['id_categoria'] ?>"><?php echo $c['nome'] ?></option>
      <?php } ?>
  	</select><br/>
    <hr/>
  <span class="nomeform">Preparado na cozinha?</span><br/>
  <input name="destino" type="radio" value="1" /><strong>Sim </strong> <input name="destino" type="radio" value="0" checked="checked" /><strong>Não</strong><br/>
  <hr/>
      <span class="nomeform">Preço de Venda:</span><br/>
      <input name="preco" type="text" class="form" size="6" id="preco"><br/><br/>
        <input name="cadastrar" type="submit" value="Cadastrar" class="button">
    
    
    </form>

</div>
</div>