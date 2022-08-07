<h1> &nbsp;&nbsp;&nbsp;Mesas</h1> 

<?php 

	if($_GET['fecha'] == "fechar") {

	$id_mesa = $_GET['id_mesa'];

	

		$delete = mysqli_query($connect,"UPDATE mesa SET situacao ='0', idGarcon = '' WHERE id_mesa = '$id_mesa' ")or die(mysql_error());

		$up = mysqli_query($connect,"UPDATE tbl_carrinho SET situacao = '0' WHERE id_mesa = '$id_mesa'")or die(mysql_error());

	}

?>







<div id="mesas">

<ul>

	<?php 

		$sql = mysqli_query($connect,"SELECT * FROM mesa ORDER BY id_mesa ASC");

		while($ver = mysqli_fetch_array($sql)){

			$situacao = $ver['situacao'];

			$id_mesa = $ver['id_mesa'];

			$numero = $ver['numero'];

			$idGarcon = $ver['idGarcon'];

			

			$gar = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon='$idGarcon'");

			$bosta = mysqli_fetch_assoc($gar);

			$nomeGarcon = $bosta['nomeGarcon'];

		

			

			if($situacao == 0){

				$img = "<img src='imagens/mesafechada.png' width='80' height='47' border='0'>";				

			}else{

			$img = "<img src='imagens/mesaaberta.png' width='80' height='47' border='0'>";

			}

	?>

	

	<li><a href="?btn=vendermesa&id_mesa=<?php echo $id_mesa ?>&idGarcon=<?php echo $idGarcon ?>"><?php echo $img; echo "<br/>";  echo 'Nº '.$numero;  echo "<br/>"; if($situacao == 1){echo "Garçom: ".$nomeGarcon; }else{echo "Abrir";} ?></a></li>





<?php }?>

</ul>

</div>