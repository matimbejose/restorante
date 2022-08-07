<h1>&nbsp;&nbsp;Gerenciar mesas</h1>

<script type="text/javascript">

function confirmardel(query){

if (confirm ("Tem certeza que deseja excluir esta mesa?")){   

 window.location="" + query;  

 return true;

 }

 else  

 window.location="?btn=cadastromesa";

 return false;

 }





</script>



<div id="mesas">

<div id="form">

	<form action="" method="post" enctype="multipart/form-data">

    	Adicnionar nova mesa: <input name="cadastrar" type="submit" value="Adicionar +" id="cadastrar" />

    

    

  </form>



  <?php 

  $contar = mysqli_query($connect,"SELECT * FROM mesa ORDER BY id_mesa DESC") or die(mysql_error());

  $linha = mysqli_fetch_array($contar);

  $cont = mysqli_num_rows($contar);

  $id = $linha['id_mesa'];

  $conf = $cont + 1;

  if($cont <= $conf){

		$nomes = $id + 1;

 }

  



  if(isset($_POST['cadastrar'])){

	  	

		$sql = mysqli_query($connect,"INSERT INTO mesa (id_mesa,numero, situacao)VALUES('$nomes','$nomes','0')")or die(mysql_error());  

		

		if($sql == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadastromesa'>";	

	}

	  

  }

  ?>

  <table width="100%" border="0" align="left" cellpadding="3" cellspacing="0" style="margin-top:5px; border:1px solid #f2f2f2; font-size:13px;">

  <tr style="border:1px solid #f2f2f2;">

    <td width="73%" align="left" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Categoría</strong></td>

    <td width="27%" align="center" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Deletar</strong></td>

  </tr>

  <?php 

  	$sel = mysqli_query($connect,"SELECT * FROM mesa ORDER BY id_mesa ASC");

	while($ver = mysqli_fetch_array($sel)){

  	$background = (++$i%2) ? '#F9F9F9' : '#F2F2F2';

  ?>

  <tr style="border:1px solid #f2f2f2;">

    <td align="left" bgcolor="<?php echo $background  ?>" style="border:1px solid #f2f2f2;">Mesa nº <?php echo $ver['numero'];?></td>

    <td align="center" bgcolor="<?php echo $background  ?>" style="border:1px solid #f2f2f2;">

    <a href="javascript:confirmardel('?btn=cadastromesa&apagar=apagar&id_mesa=<?php echo $ver['id_mesa'] ?>')"><img src="imagens/icone_delete.gif" width="17" height="18"  border="0"/></a>

    </td>

  </tr>

  <?php } ?>

  </table>

<?php 

if($_GET['apagar'] == "apagar"){

		$id = $_GET['id_mesa'];

		$del = mysqli_query($connect,"DELETE FROM mesa WHERE id_mesa = '$id'");

		

		if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadastromesa'>";

					}



							}



?>

  

  </div>

</div>