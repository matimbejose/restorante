<h1>configurações</h1>



<div id="boxcadProdutos">

<div id="formconfig">

<?php

$sql = mysqli_query($connect,"SELECT * FROM config");

$ver = mysqli_fetch_array($sql);



$s = mysqli_query($connect,"SELECT * FROM garcon WHERE idGarcon='1'");

$usu = mysqli_fetch_array($s);



?>



<form action="" method="post" enctype="multipart/form-data">



           Empresa:<br/>

           <input name="empresa" type="text"  value="<?php echo $ver["empresa"]; ?>" size="45"> <br/><br/>

           Telefone:<br/>

           <input name="telefone" type="text"  value="<?php echo $ver["telefone"]; ?>"><br/>

         <input name="gravar" type="submit" class="button" value="Gravar">

    

    

    

    </form>

    <hr /> 

    <strong>Configurações de taxas adicionais:</strong><br/><br/>

    

   <form action="" method="post" enctype="multipart/form-data">

   Percentual do Garçon:

   <input name="pgarcon" type="text" value="<?php echo $ver['pgarcon'] ?>" size="3" maxlength="2" />%<br/>

   Ativado:<input name="ativo" type="radio" value="1" <?php if($ver['ativo'] == 1){ echo 'checked="checked"';} ?>  /> Desativado: <input name="ativo" type="radio" value="0" <?php if($ver['ativo'] == 0){ echo 'checked="checked"';} ?>/><br/>

   <input name="ok" type="submit" value="OK" id="ok" class="button" />

   </form> 

    <hr />

    <strong>Configurações de usuário:</strong><br/><br/>

    <form action="" method="post" enctype="multipart/form-data">

	Nome do usuário:<br/>

    <input name="nome" type="text" id="nome" value="<?php echo $usu['nomeGarcon'] ?>" /><br/>

    Login:<br/>

    <input name="login" type="text" id="login" value="<?php echo $usu['login'] ?>" /><br/>

    Senha:<br/>

    <input name="senha" type="text" id="senha" value="<?php echo $usu['senha'] ?>" /><br/>

   <input name="alterar" type="submit" value="Alterar" id="alterar" class="button" />

   </form> 

    

    

    <?php 

	if(isset($_POST['gravar'])){

		

		$empresa = $_POST['empresa'];

		$telefone = $_POST['telefone'];

		

	$up = mysqli_query($connect,"UPDATE config SET empresa='$empresa', telefone='$telefone'");

	

		if($up == 1){

	print "

	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=config'>

	<script type=\"text/javascript\">

	alert(\"Alterado com sucesso.\");

	</script>";	

	}

	

	

	}

	if(isset($_POST['ok'])){

		$pgarcon = $_POST['pgarcon'];

		$ativo = $_POST['ativo'];

		

	$up = mysqli_query($connect,"UPDATE config SET pgarcon='$pgarcon', ativo='$ativo'");

	

		if($up == 1){

	print "

	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=config'>

	<script type=\"text/javascript\">

	alert(\"Alterado com sucesso.\");

	</script>";	

	}

	

	

	}

	if(isset($_POST['alterar'])){

		$nome = $_POST['nome'];

		$login2 = $_POST['login'];

		$senha2 = $_POST['senha'];

		

	$up = mysqli_query($connect,"UPDATE garcon SET nomeGarcon='$nome', login='$login2', senha='$senha2' WHERE idGarcon='1'") or die(mysql_error());

	

		if($up == 1){

	print "

	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=config'>

	<script type=\"text/javascript\">

	alert(\"Alterado com sucesso.\");

	</script>";	

	}

	

	

	}

	?>

</div>

</div>