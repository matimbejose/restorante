<?php
  include"../conexao/config.php";

  $q = strtolower($_GET["q"]);

if(!$q) return;

  $sql = mysql_query("SELECT * FROM pedido WHERE nome LIKE '%$q%' LIMIT 10") or die("Erro ao consultar");
		 while($res = mysql_fetch_array($sql)){
				
					$nome = $res['nome'];
					$id = $res['id_mesa'];
					$idgracon = $res['idGarcon'];
					 
					
					echo '<a href="inicio2.php?btn=vendapedido&id_mesa='.$id.'&idGarcon='.$idgracon.'">';
					
					echo "<div class=\"res\">";
					echo "<div class=\"nome\">$nome...</div>\n";
					echo "</div>";
					
					
				
					
					echo '</a>';
					
				
			
							  }
?>
