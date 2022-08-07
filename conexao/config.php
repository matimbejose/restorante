<?php	

  /// DADOS DE ACESSO AO SERVIDOR MySQL LOCALHOST

  $host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $my_db   = "marcost_cook";

	

  /// REALIZA A CONEXÃO
  $conect = mysqli_connect($host_db,$user_db ,$pass_db);
            mysqli_select_db($my_db, $conect);

?>

