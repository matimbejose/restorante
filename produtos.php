<?php
include "config/conexao.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: WebMaster.PT :: Carrinho de Compras ::.</title>
</head>  
<body>
<div align="center">

<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
<tr>
 <td>
<?php
 $sql = "SELECT * FROM tbl_produtos ORDER BY RAND() LIMIT 0,4";
 GeraColunas(2, $sql)
 ?>
</td>
</tr>
</table>
<?php
//*********************************************************************
// FUNÇÃO: GERACOLUNAS
//*********************************************************************
function GeraColunas($pNumColunas, $pQuery) {
$resultado = mysql_query($pQuery);
echo ("<table width='100%' border='0'>\n");
 for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {
 
 for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
  $linha = mysql_fetch_array($resultado);
  if ($i > $linha) {
   if ( $intCont < $pNumColunas-1) echo "</tr>\n";
   break;
  }

  $cod = $linha[0];
  $nome = $linha[1];
  $img = $linha[2];
  $preco = number_format($linha[3],2,",",".");

  if ( $intCont == 0 ) echo "<tr>\n";
  echo "<td>";
  // Aqui você inclui o conteudo
  echo "<table width='266' border='0' cellspacing='0' cellpadding='0'>
  <tr><td width='250' height='141' valign='middle'><div align='center'><img src='imagens/produtos/".$img."' border='0' width='189' height='141' /></div></td></tr>

  <tr><td><table width='92%' border='0' align='center' cellpadding='0' cellspacing='0'>
  
  <tr><td><div align='center' style='font-size:10px;font-family:Verdana'><strong><a href='carrinho.php?cod=".$cod."&acao=incluir'>".$nome."</a></strong></div><strong><div align='center'><font color='#FF0000' size='4px'>  ".$preco." </font></strong></div></td></tr>
  
  <tr><td><div align='center' style='font-size:10px;font-family:Verdana'><a href='carrinho.php?cod=".$cod."&acao=incluir'><img src='imagens/add_carrinho.jpg' border='0'/></a></div><br></td>
  </tr>
  </table>
  </td></tr>
  </table>";
  
   // Aqui é o final do conteudo
  echo "</td>";

  if ( $intCont == $pNumColunas-1 ) {
   echo "</tr>\n";
  } else { $i++; }
 }
 
 }
echo ('</table>');
}

?>
</div>
</body>
</html>
