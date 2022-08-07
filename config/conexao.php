<?php 
// ALTERE OS DADOS DAS STRINGS (NOMES QUE ESTÃO ENTRE AS ASPAS)
// $host = "localhost"; // endereco do banco de dados
// $usuario = "root"; // usuario do banco de dados
// $senhadobanco = " "; // senha do banco de dados
// $nomedobanco = "marcost_cook"; //nome do banco de dados
// NÃO ATERAR NADA DAQUI PARA BAIXO
// $db = mysql_connect($host,$usuario,$senhadobanco) or die (mysql_error());
// $banco = mysql_select_db($nomedobanco,$db)or die (mysql_error());
// mysql_set_charset('utf8');
// $conn = new mysqli('localhost', 'root', '');
// try
// {
//     $conn = new PDO("mysql:host=localhost;dbname=marcost_cook", 'root', '');
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOException $e)
// {
//     echo $e->getMessage();
// }


//conexao com base de dados myqsl
$servaname = "localhost";
$username = "root";
$password = "";
$db_name ="marcost_cook";


//abrindo a conexao
$connect = mysqli_connect($servaname, $username, $password, $db_name);
mysqli_set_charset($connect, "utf-8");

// var_dump($connect);

if(mysqli_connect_error()){
    echo "erro na conexao: ". mysql_connect_error();
} 
?>


