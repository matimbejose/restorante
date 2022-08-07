
<form action="" method="post" enctype="multipart/form-data" style="margin-left:12px; margin-top:-7px;">
Selecione a categoría: 
  <select name="categoria" id="categoria">
  <option value=""> =Selecione=</option>
  <?php 
  include "config/conexao.php";
  	$salto = mysql_query("SELECT * FROM categoria ORDER BY nome ASC");
	while($aaa = mysql_fetch_array($salto)){
  ?>
  
    <option value="inicio.php?btn=nova&id_categoria=<?php echo $aaa['id_categoria']; ?>"><?php echo $aaa['nome'] ?></option>
    
    <?php } ?>
  </select>
</form>