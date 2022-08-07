<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Preço</title>
 <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
 <script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $("#preco").maskMoney({decimal:".",thousands:"."});
		
      });
	  
	  
</script>
<script language="javascript">
function fechajanela() {
window.open("inicio.php?btn=cadGarcon","main");
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
	$nome = $_POST['nomeGarcon'];
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$nv	= $_POST['nv'];
	
	$conf = mysql_query("SELECT * FROM garcon WHERE login ='$login'");
	$conta = mysql_num_rows($conf);
	
	if($conta != 0){
		echo '<script type=\"text/javascript\">
		alert("Já existe um usuário cadastrado com este login"),
		javascript:window.close()
		</script>';	
	}
	
	
	$sql = mysql_query("UPDATE garcon SET nomeGarcon='$nome', login = '$login', senha='$senha', nv='$nv' WHERE idGarcon='$cods'")or die(mysql_error());
	
	if($sql == 1){
	print"<script type=\"text/javascript\">javascript:window.close()</script>";	
	}
	
	
}



?>
<div id="boxcadProdutos">
	<div id="form">
    
    <?php 

	$cod = $_GET['cod'];
	$sql_select = mysql_query("SELECT * FROM garcon WHERE idGarcon='$cod'");
		$ver = mysql_fetch_array($sql_select);
		$nivel = $ver['nv'];
	?>
    
	<form action="" name="form" method="post" enctype="multipart/form-data">
    	<span class="nomeform">Nome:</span><br/>
  <input name="nomeGarcon" type="text" class="form2" id="nomeGarcon" value="<?php echo $ver['nomeGarcon'] ?>" size="35" maxlength="35"><br/>
  <strong>Nível de acesso:</strong><br/>
    Administrador:<input name="nv" type="radio" value="0" <?php if($nivel == 0){echo "checked='checked'";}?>/> |
    Garçom:<input name="nv" type="radio" value="1" <?php if($nivel == 1){echo "checked='checked'";}?>/> |
    Cozinha:<input name="nv" type="radio" value="2" <?php if($nivel == 2){echo "checked='checked'";}?> /><br/>
  
  
      <span class="nomeform">Login:</span><br/>
      <input name="login" type="text" class="form" id="login" value="<?php echo $ver['login']; ?>" size="6"><br/>
      <span class="nomeform">Senha:</span><br/>
      <input name="senha" type="text" class="form" id="senha" value="<?php echo $ver['senha']; ?>" size="6"><br/>
        <input name="alterar" type="submit" value="Alterar" class="button">
        <a href="javascript:window.close()"><input name="" type="button" value="Fechar" class="button" /></a>
    
    
    </form>

</div>
</div>




</body>
</html>