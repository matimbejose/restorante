<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Painel de controle</title>

<style type="text/css">

body{background:url(imagens/bg_topo.jpg) repeat-x top; background-color:#f3f1f1; }

#topo{text-align:center; font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#666;}

#login{width:300px; margin:20px auto; font:bold 16px Tahoma, Geneva, sans-serif;font-style:normal; color:#333; background:url(imagens/login_bg.gif) no-repeat left center; border:3px solid #ffffff; background-color:#d7d7d7;

text-shadow:0px -1px 1px #222222;box-shadow:2px 2px 5px #000000;-moz-box-shadow:2px 2px 5px #000000;-webkit-box-shadow:2px 2px 5px #000000;

border-radius:10px 10px 10px 10px;-moz-border-radius:10px 10px 10px 10px;-webkit-border-radius:10px 10px 10px 10px;

width:300px; padding:10px 43px 30px 70px;}

form{padding:30px;}

label input[type=text],input[type=password]{display:block; margin:5px 0; padding:5px; border:1px solid #999; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;}

input[type=submit]{

	color:#FFF; font-size:14px;

	padding:5px 10px;

	margin-bottom:12px;

	margin-left:0px;

	float:left; 

	border-color:#cfcdcd #c0bebe #c0bebe #cfcdcd;

	border-style:solid;

	border-width:1px;

	box-shadow:1px 1px 1px #033;

	border-radius:3px;

	-moz-border-radius:3px;

	-webkit-border-radius:3px;

	cursor:pointer;

	

background: #299a0b; /* Old browsers */

background: -moz-linear-gradient(top,  #299a0b 0%, #299a0b 100%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#299a0b), color-stop(100%,#299a0b)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #299a0b 0%,#299a0b 100%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #299a0b 0%,#299a0b 100%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #299a0b 0%,#299a0b 100%); /* IE10+ */

background: linear-gradient(to bottom,  #299a0b 0%,#299a0b 100%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#299a0b', endColorstr='#299a0b',GradientType=0 ); /* IE6-9 */



}

#erro{font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#F00; text-align:center;}

</style>

</head>

<body>

<div id="topo"><img src="imagens/logar.png" width="200" height="120"  border="0" title="Logomarca"/><br/></div>



<div id="login">

<div id="erro">

<?php 
error_reporting(0);
$erro = $_GET['login_errado'];
error_reporting(0);
$logar = $_GET['logar'];
		if($erro == "erro"){
		echo "Login ou Senha não conferem.";
		}		

		elseif($logar == "errar"){
		echo "Você tem permissão para acessar somente com aparelho mobile.";
	}

?>

</div>

<form action="login.php" method="POST">

	&raquo; Login:<br/>

    <label>

  <input type="text" name="login" />

  </label>

 	&raquo; Senha:<br/>

    <label>

  <input type="password" name="senha" />

  </label>

  <input type="submit" name="logar" value="Entrar" />

</form>

</div>



</body>
</html>