<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Preço</title>
 <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
 <script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $("#preco").maskMoney({decimal:",",thousands:"."});
		
      });
	  
	  
</script>
<script language="javascript">
function fechajanela() {
window.open("inicio.php?btn=alterapreco","main");
}
</script>

<style type="text/css">
body {
	background-color: #F2F2F2;
}
.button {	
		   border: 1px solid #BBB;
		   border-radius: 3px;
		   text-shadow: 0 1px 1px white;
		   -webkit-box-shadow: 0 1px 1px #fff;
		   -moz-box-shadow:    0 1px 1px #fff;
		   box-shadow:         0 1px 1px #fff;
		   font: bold 11px Sans-Serif;
		   padding: 6px 10px;
		   white-space: nowrap;
		   vertical-align: middle;
		   color: #666;
		   background: transparent;
		   cursor: pointer;
		   margin-top:3px;
		   text-decoration:none;
		   
		}
		.button:hover, .button:focus {
		   border-color: #999;
		   background: -webkit-linear-gradient(top, white, #E0E0E0);
		   background:    -moz-linear-gradient(top, white, #E0E0E0);
		   background:     -ms-linear-gradient(top, white, #E0E0E0);
		   background:      -o-linear-gradient(top, white, #E0E0E0);
		   -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
		   -moz-box-shadow:    0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
		   box-shadow:         0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
		   margin-top:3px;
		   text-decoration:none;
		}
		.button:active {
		   border: 1px solid #AAA;
		   border-bottom-color: #CCC;
		   border-top-color: #999;
		   -webkit-box-shadow: inset 0 1px 2px #aaa;
		   -moz-box-shadow:    inset 0 1px 2px #aaa;
		   box-shadow:         inset 0 1px 2px #aaa;
		   background: -webkit-linear-gradient(top, #E6E6E6, gainsboro);
		   background:    -moz-linear-gradient(top, #E6E6E6, gainsboro);
		   background:     -ms-linear-gradient(top, #E6E6E6, gainsboro);
		   background:      -o-linear-gradient(top, #E6E6E6, gainsboro);
		   margin-top:3px;
		   text-decoration:none;
		}
		.button:after {
		   content: "";
		   display: inline-block;
		   width: 0;
		   height: 0;
		   border-top: 4px solid #999;
		   border-left: 4px solid transparent;
		   border-right: 4px solid transparent;
		   margin: 0 0 0 4px;
		   position: relative;
		   top: -1px;
		   text-decoration:none;
		}
		.button:hover:after {
		   border-top-color: black;
		   text-decoration:none;
		}
.form{ padding: 6px 5px; text-align:right; border:1px solid #666; font-size:18px; font-weight:bold; color:#063; background: #FFD7C4;}
.form2{ padding: 6px 10px; text-align:left; border:1px solid #666; font-size:18px; font-weight:bold; color:#063; background: #FFD7C4;}
</style>
</head>

<body onunload="fechajanela()">
<?php 
	include "config/conexao.php"; 
if(isset($_POST['alterar'])){
	$cods = $_GET['cod'];
	$nome = $_POST['nome'];
	$precov 	=  str_replace(".", "",$_POST['preco']);
	$preco = str_replace(",", ".",$precov);
	
	$sql = mysql_query("UPDATE tbl_produtos SET nome='$nome', preco = '$preco' WHERE cod='$cods'")or die(mysql_error());
	
	if($sql == 1){
	print"<script type=\"text/javascript\">javascript:window.close()</script>";	
	}
	
	
}



?>





<div id="boxcadProdutos">
	<div id="form">
    
    <?php 

	$cod = $_GET['cod'];
	$sql_select = mysql_query("SELECT * FROM tbl_produtos WHERE cod='$cod'");
		$ver = mysql_fetch_array($sql_select);
	?>
    
	<form action="" name="form" method="post" enctype="multipart/form-data">
    	<span class="nomeform">Nome do Produto:</span><br/>
  <input name="nome" type="text" class="form2" id="nome" value="<?php echo $ver['nome'] ?>" size="35" maxlength="35"><br/>
        <span class="nomeform">Preço de Venda:</span><br/>
      <input name="preco" type="text" class="form" id="preco" value="<?php echo  str_replace(".",",",$ver['preco']); ?>" size="6"><br/>
        <input name="alterar" type="submit" value="Alterar" class="button">
        <a href="javascript:window.close()"><input name="" type="button" value="Fechar" class="button" /></a>
    
    
    </form>

</div>
</div>




</body>
</html>