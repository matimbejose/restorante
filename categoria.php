<h1>&nbsp;&nbsp;Cadastro de categorías</h1>

<script type="text/javascript">

function confirmardel(query){

if (confirm ("Tem certeza que deseja excluir esta categoría?")){   

 window.location="" + query;  

 return true;

 }

 else  

 window.location="?btn=categoria";

 return false;

 }

</script>

<div id="mesas">

<div id="form">

	<form action="" method="post" enctype="multipart/form-data">

    	Nome: <input name="nome" type="text" size="40" /><input name="cadastrar" type="submit" value="Cadastrar" id="cadastrar" />

    

    

  </form>



  <?php 

  if(isset($_POST['cadastrar'])){

	  

	  $nomes = $_POST['nome'];

		

		$sql = mysqli_query($connect,"INSERT INTO categoria (nome)VALUES('$nomes')")or die(mysql_error());  

		

		if($sql == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=categoria'>";	

	}

	  

  }

  ?>

  <table width="100%" border="0" align="left" cellpadding="3" cellspacing="0" style="margin-top:5px; border:1px solid #f2f2f2; font-size:13px;">

  <tr style="border:1px solid #f2f2f2;">

    <td width="73%" align="left" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Categoría</strong></td>

    <td width="27%" align="center" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Deletar</strong></td>

  </tr>

  <?php 

  	$sel = mysqli_query($connect,"SELECT * FROM categoria ORDER BY id_categoria DESC");

	while($ver = mysqli_fetch_array($sel)){

  	$background = (++$i%2) ? '#F9F9F9' : '#F2F2F2';

  ?>

  <tr style="border:1px solid #f2f2f2;">

    <td align="left" bgcolor="<?php echo $background  ?>" style="border:1px solid #f2f2f2;"><?php echo $ver['nome'];?></td>

    <td align="center" bgcolor="<?php echo $background  ?>" style="border:1px solid #f2f2f2;">

    <a href="javascript:confirmardel('?btn=categoria&apagar=apagar&id_categoria=<?php echo $ver['id_categoria'] ?>')"><img src="imagens/icone_delete.gif" width="17" height="18"  border="0"/></a>

    </td>

  </tr>

  <?php } ?>

  </table>

<?php 

if($_GET['apagar'] == "apagar"){

		$id = $_GET['id_categoria'];

		$del = mysqli_query($connect,"DELETE FROM categoria WHERE id_categoria = '$id'");

		

		if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=categoria'>";

					}



							}



?>

  

  </div>

</div>