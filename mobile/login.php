<?php 
session_start();
ob_start(); 
include "../config/conexao.php";
$login = $_POST['login']; 
$senha = $_POST['senha'];

$sql = mysql_query("SELECT * FROM garcon WHERE login='$login' AND senha='$senha' AND nv !='2'") or die(mysql_error()); 
if(mysql_num_rows($sql) == 1){
	$_SESSION['garcon_session'] = $login;
	$_SESSION['senha_session'] = $senha;
	header("Location:mesas.php");
}else{
	unset($_SESSION['garcon_session']);
	unset($_SESSION['senha_session']);
	header("location:index.php?login_errado=erro");

}

?>