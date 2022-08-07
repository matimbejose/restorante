<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_sistema = "localhost";
$database_sistema = "root";
$username_sistema = "marcost_cook";
$password_sistema = "";


$sistema = mysqli_connect($hostname_sistema, $username_sistema, $password_sistema) or trigger_error(mysql_error(),E_USER_ERROR); 

?>