<?php 

backup_bd('localhost','root','','sisvendas');

date_default_timezone_set('America/Sao_Paulo'); 

/* Fazer Backup da BD ou só de uma Tabela */

function backup_bd($host,$utilizador,$password,$nome,$tabelas = '*')

{

 

    $link = mysqli_connect($connect,$host,$utilizador,$password);

    mysqli_select_db($nome,$link);

 

    //obter todas as tabelas

    if($tabelas == '*')

    {

        $tabelas = array();

        $resultado = mysqli_query($connect,'SHOW TABLES');

        while($coluna = mysqli_fetch_row($resultado))

        {

            $tabelas[] = $coluna[0];

        }

    }

    else

    {

        $tabelas = is_array($tabelas) ? $tabelas: explode(',',$tabelas);

    }

 

    foreach($tabelas as $tabelas)

    {

        $resultado = mysqli_query($connect,'SELECT * FROM '.$tabelas);

        $num_campos = mysqli_num_fields($resultado);

 

        $return.= 'DROP TABLE '.$tabelas.';';

        $coluna2 = mysqli_fetch_row($connect,mysql_query('SHOW CREATE TABLE '.$tabelas));

        $return.= "\n\n".$coluna2[1].";\n\n";

 

        for ($i = 0; $i < $num_campos; $i++)

        {

            while($coluna = mysqli_fetch_row($resultado))

            {

                $return.= 'INSERT INTO '.$tabelas.' VALUES(';

                for($j=0; $j<$num_campos; $j++)

                {

                    $coluna[$j] = addslashes($coluna[$j]);

                    $coluna[$j] = ereg_replace("\n","\\n",$coluna[$j]);

                    if (isset($coluna[$j])) { $return.= '"'.$coluna[$j].'"' ; } else { $return.= '""'; }

                    if ($j<($num_campos-1)) { $return.= ','; }

                }

                $return.= ");\n";

            }

        }

        $return.="\n\n\n";

    }

 

    //guarda ficheiro

	date_default_timezone_set('America/Sao_Paulo'); 

	$data = date("d-m-Y - H.m.s");

    $ficheiro = fopen('backup-'.$data.'.sql','w+');

    fwrite($ficheiro,$return);

    fclose($ficheiro);

}



	print "

	<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php'>

	<script type=\"text/javascript\">

	alert(\"Backup da base de dados feito com sucesso.\");

	</script>";





?>