<?php

include "config/conexao.php";



####  verificando de a session existe ou nao #####



// inicia  a sessiom

session_start();

//se nao existir volta para a pagina do form de login

if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){

	header("Location:index.php");

	exit;		

}

//// a parte acima deve estar em todas as paginas onde houver restrições de acesso no site

$login = $_SESSION['login_session'];

$senha = $_SESSION['senha_session'];

// seleciona o nome no campo da tabela

$sql = mysqli_query($connect,"SELECT * FROM usuario WHERE login='$login' AND senha='$senha'");

$linha = mysqli_fetch_array($sql);

	$nome = $linha['nome'];





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$num = @$_GET['number'];

if(@$_GET['btn'] =="cancela"){

		$del = mysqli_query($connect,"DELETE FROM tbl_carrinho WHERE comanda = '$num' ") or die(mysql_error());

		

		if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=nova'>";



	}



  }

  



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>.:  Controle de vendas</title>

<link href="css/style.css" rel="stylesheet" type="text/css">

<link href="css/css.css" rel="stylesheet" type="text/css">

<link href="css/jquery-uicss.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-latest.js"></script>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>

<script>

$(function() {

$( "#datai" ).datepicker({dateFormat: 'dd-mm-yy'});

$( "#dataf" ).datepicker({dateFormat: 'dd-mm-yy'});



});

</script>

</script>

<strong>

<style media="print">

.naomostra {

display: none;

}



</style></strong>

</head>  

<body>

<div class="naomostra">

<div id="menu"><center><?php include "menu.php"?></center></div></div>

<div id="geral">

	<?php 
	error_reporting(0);
		if($_GET['btn'] == "nova"){

			include "vender.php";

		error_reporting(0);
		}elseif($_GET['btn'] == "cadastroProdutos"){

			include "cadastroProdutos.php";

			error_reporting(0);
		}elseif($_GET['btn'] == "alterapreco"){

			include "alterapreco.php";

			error_reporting(0);
		}elseif($_GET['btn'] == "relatorio"){

			include "relatorio.php";

		}
		elseif($_GET['btn'] == "config"){

			include "config.php";

		}
		elseif($_GET['btn'] == "mesa"){

			include "mesas.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "entrega"){

			include "entrega.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "vendermesa"){

			include "vendamesa.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "categoria"){

			include "categoria.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "cadastromesa"){

			include "cadastromesa.php";}

			
			// error_reporting(0);
			elseif($_GET['btn'] == "vendapedido"){

			include "vendapedido.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "cadastroclientes"){

			include "cadastrarcliente.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "cadGarcon"){

			include "cadGarcon.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "relatoriogarcon"){

			include "relatoriogarcon.php";

		}
		// error_reporting(0);
		elseif($_GET['btn'] == "garcon"){

			include "vendagarcon.php";

		}

		else{

			include "logo.php";	

		}

	

	?>

    <br/>

</div>



</body>

</html>

