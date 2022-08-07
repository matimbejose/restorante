<h1> Cadastro de Usuários</h1>

<script type="text/javascript">

	 var win = null;

	function NovaJanela(pagina,nome,w,h,scroll){

	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'

	win = window.open(pagina,nome,settings);

	}



window.name = "main";



function confirmardel(query){

if (confirm ("Tem certeza que deseja excluir este garçom?")){   

 window.location="" + query;  

 return true;

 }

 else  

 window.location="?btn=cadGarcon";

 return false;

 }

</script>

<div id="boxcadProdutos">

	<?php 

	if(isset($_POST['cadastrar'])){

		$nome = $_POST['nomeGarcon'];

		$login = $_POST['login'];

		$senha = $_POST['senha'];

		

		$sql = mysqli_query($connect,"SELECT * FROM garcon WHERE login='$login'");

		$conf = mysqli_num_rows($sql);

		if($conf == 1){

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadGarcon'>

		<script type=\"text/javascript\">

		alert(\"ERRO!! Já existe um usuário cadastrado com este login.!\");

		</script>";	

			

		}else{

		

		

		$nv	= $_POST['nv'];

		$bd = mysqli_query($connect,"INSERT INTO garcon (nomeGarcon,login,senha,nv)VALUES('$nome','$login','$senha','$nv')")or die(mysql_error());	

	if($dbd == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadGarcon'>";	

	}

	

	}

	}

	?>





	<div id="form">

    <form action="" method="post" enctype="multipart/form-data">

   <strong> Nome:</strong> <input name="nomeGarcon" type="text" id="nome">

    <strong>Login:</strong><input name="login" type="text" /><strong> Senha: </strong><input name="senha" type="password" /><br/><br/>

    

    <strong>Nível de acesso:</strong><br/>

    Administrador:<input name="nv" type="radio" value="0" /> Garçom:<input name="nv" type="radio" value="1" /> Cozinha:<input name="nv" type="radio" value="2" /><br/><br/>

    <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar"><br/><br/>

    </form>

    <hr/>

 <table width="100%" border="0" cellpadding="3" cellspacing="0" style="font-size:12px;">

  <tr>

    <td width="9%" align="left" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Código</strong></td>

    <td width="80%" align="left" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Nome</strong></td>

    <td width="11%" align="center" bgcolor="#66CCFF" style="border:1px solid #f2f2f2;"><strong>Ação</strong></td>

  </tr>

  <?php 

  $ver = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon != '1' ORDER BY idGarcon DESC");

   $ver2 = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon != '2' ORDER BY idGarcon DESC");

   while($r2 = mysqli_fetch_array($ver2))

   while($r = mysqli_fetch_array($ver)){

  

  ?>

  <tr>

    <td align="left" style="border:1px solid #f2f2f2;"><?php echo $r['idGarcon'] ?></td>

    <td align="left" style="border:1px solid #f2f2f2;"> <?php 

	

	if ($ver == ""){

		echo $r2['login'];}

		

	else{

	echo $r['nomeGarcon'];}

	

	

	

	?></td>

    <td align="center" style="border:1px solid #f2f2f2;">

    <a href="updateGarcon.php?cod=<?php echo $r['idGarcon'] ?>" onclick="NovaJanela(this.href,'nomeJanela','400','260','yes');return false"><img src="imagens/file_edit.png" width="20" height="20" border="0" /></a>

     

    <a href="javascript:confirmardel('inicio.php?btn=cadGarcon&del=del&idGarcon=<?php echo $r['idGarcon'] ?>')">

    <img src="imagens/excluir.png" width="20" height="20" border="0"></a>

    </td>

  </tr>

  <?php } ?>

</table>

  

  <?php 

  if($_GET['del'] == "del"){

	  $id = $_GET['idGarcon'];

	  $del = mysqli_query($connect,"DELETE FROM garcon WHERE idGarcon='$id'")or die(mysql_error());

	  if($del == 1){

	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=cadGarcon'>";	

	}

  }

  

  ?>

  

</div>

</div>