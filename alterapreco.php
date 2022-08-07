<?php

include "config/conexao.php";



if(isset($_POST['alterar'])){

	$cod	= $_POST['cod'];

	$nome 	= $_POST['nome'];

	$preco 	= $_POST['preco'];



	$sql = mysql_query("UPDATE tbl_produtos SET nome = '$nome', preco ='$preco' WHERE cod ='$cod'") or die(mysql_error());	

	

	if($sql == 1){

	print "

	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?btn=alterapreco'>

	<script type=\"text/javascript\">

	alert(\"Alterado com sucesso.\");

	</script>";	

	}

}









?>

<style type="text/css">

#bosta{

	padding:20px 0 0px 20px;

	font-size:13px;

	position: relative;

}

</style>



<h1>Alterar preços / excluir produtos</h1>

 <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

 <script type="text/javascript" src="js/jquery.mask-money.js"></script>

<script type="text/javascript">

$(document).ready(function() {

        $("#preco").maskMoney({decimal:".",thousands:","});

		

      });

	  

	 var win = null;

	function NovaJanela(pagina,nome,w,h,scroll){

	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'

	win = window.open(pagina,nome,settings);

	}



window.name = "main";



function confirmardel(query){

if (confirm ("Tem certeza que deseja excluir este produto")){   

 window.location="deletaproduto.php" + query;  

 return true;

 }

 else  

 window.location="?btn=alterapreco";

 return false;

 }



</script>	  

<div layer="bosta">

      <form action="?btn=alterapreco&pesquizar=pesquizar" method="post" enctype="multipart/form-data">

Pesquisar produto: <input name="pesquizar" type="text" /><input name="" type="submit" value="Pesquisar" />

</form>

    

    

    </div>

<div id="boxcadProdutos">





  <div id="altera">



	

<table width="100%" border="0" cellpadding="3" cellspacing="0">

  <tr>

    <td width="71%" bgcolor="#66CCFF"><strong>&nbsp;&nbsp;&nbsp;Produto</strong></td>

    <td width="11%" align="center" bgcolor="#66CCFF"><strong>Preço</strong></td>

    <td width="10%" align="center" bgcolor="#66CCFF"><strong>Alterar</strong></td>

    <td width="8%" align="center" bgcolor="#66CCFF"><strong>Excluir</strong></td>

  </tr>

  

  	<?php 

	$pesquizar = $_POST['pesquizar'];

	$sql_select = mysql_query("SELECT * FROM tbl_produtos WHERE nome like'$pesquizar%' ORDER BY nome ASC");

	while($ver = mysql_fetch_array($sql_select)){

		$background = (++$i%2) ? '#e7e7e7' : '#F2F2F2';

	?>

  <tr>

    <td style="font-size:14px;" bgcolor="<?php echo $background ?>">&nbsp;&nbsp;&nbsp;<?php echo $ver['nome'] ?></td>

    <td align="center" style="font-size:14px;" bgcolor="<?php echo $background ?>"><?php echo str_replace(".",",",$ver['preco']); ?></td>

    <td align="center" style="font-size:14px;" bgcolor="<?php echo $background ?>">

         <a href="updatePreco.php?cod=<?php echo $ver['cod']?>" 

         onclick="NovaJanela(this.href,'nomeJanela','400','260','yes');return false">

         <img src="imagens/file_edit.png" width="20" height="20" border="0" />

         </a>

 </td>

    <td align="center" style="font-size:14px;" bgcolor="<?php echo $background ?>">

    <a href="javascript:confirmardel('?cod=<?php echo $ver['cod']?>')"><img src="imagens/excluir.png" width="20" height="20" border="0" /></a>

    

    </td>

  </tr>

  <?php } ?>

</table>



    

    

 



</div>

</div>