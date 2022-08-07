<?php require_once('Connections/sistema.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pedido (id_mesa, numero, idGarcon, situacao, email, nome, sobrenome, telefone, bairro, rua, numerocasa, detalhes) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_mesa'], "int"),
                       GetSQLValueString($_POST['numero'], "int"),
                       GetSQLValueString($_POST['idGarcon'], "text"),
                       GetSQLValueString($_POST['situacao'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['rua'], "text"),
                       GetSQLValueString($_POST['numerocasa'], "text"),
                       GetSQLValueString($_POST['detalhes'], "text"));

  mysql_select_db($database_sistema, $sistema);
  $Result1 = mysql_query($insertSQL, $sistema) or die(mysql_error());


  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
 
}
?>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>

<script type="text/javascript">
  $().ready(function(){
	$("#busca").autocomplete("ajax/busca.php", {
		width: 300,
		matchContains: true,
		selectFirst: false
	});
  });
</script>
<script type="text/javascript">
function exibe(id) {
	if(document.getElementById(id).style.display=="none") {
		document.getElementById(id).style.display = "inline";
	}
	else {
		document.getElementById(id).style.display = "none";
	}
}
</script>
<h1>&nbsp;&nbsp;Cadastrar clientes</h1>
<div class="div"><center>
    <form method="post" action="buscar.php">
      <input size="32" type="text" class="busca" id="busca" name="buscar" value="buscar no site..." onfocus="if (this.value == 'buscar no site...') this.value = '';" onblur="if (this.value == '') this.value = 'buscar no site...';" />
      
    </form></center>
  </div>
<br />
<div id="conteudo">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Email:</td>
        <td><input type="text" name="email" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nome:</td>
        <td><input type="text" name="nome" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Sobrenome:</td>
        <td><input type="text" name="sobrenome" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Telefone:</td>
        <td><input type="text" name="telefone" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Bairro:</td>
        <td><input type="text" name="bairro" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Rua:</td>
        <td><input type="text" name="rua" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Numerocasa:</td>
        <td><input type="text" name="numerocasa" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Detalhes:</td>
        <td><textarea name="detalhes" cols="50" rows="5"></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insert record" /></td>
      </tr>
    </table>
    <input type="hidden" name="id_mesa" value="" />
    <input type="hidden" name="numero" value="<?php
echo date("d/m/Y");
?>" />
    <input type="hidden" name="idGarcon" value="9" />
    <input type="hidden" name="situacao" value="0" />
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>
</div>



<p>&nbsp;</p>
