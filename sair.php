<?php 
// desttroi a sessao
session_start();
unset($_SESSION['login_session']);
unset($_SESSION['senha_session']);
unset($_SESSION['cozinha_session']);
header("location:index.php");
?>
