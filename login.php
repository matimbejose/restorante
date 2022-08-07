<?php 



session_start(); 

ob_start();

include "config/conexao.php";

$login = $_POST['login']; 

$senha = $_POST['senha'];



//abrindo a conexao
$sql = mysqli_query($connect,"SELECT * FROM garcon WHERE login='$login' AND senha='$senha'") or die(mysql_error()); 
// var_dump($sql);

$conf = mysqli_fetch_array($sql);

$nv = $conf['nv'];



if(mysqli_num_rows($sql) == 1 and $nv == "0"){

	$_SESSION['login_session'] = $login;

	$_SESSION['senha_session'] = $senha;

	header("Location:inicio.php?btn=inicio");

	}

elseif(mysqli_num_rows($sql) == 1 and $nv == "2"){

	$_SESSION['cozinha_session'] = $login;

	$_SESSION['senha_senha'] = $senha;

	header("Location:pedidoscozinha.php");

	}

elseif($nv == 1){

	unset($_SESSION['login_session']);

	unset($_SESSION['senha_session']);

	header("location:logar.php?logar=errar");



}else{

	unset($_SESSION['login_session']);

	unset($_SESSION['senha_session']);

	header("location:logar.php?login_errado=erro&logar=errar");



}



?>