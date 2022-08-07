<?php

session_start(); 
ob_start();
require_once('mobile_device_detect.php');
$mobile = mobile_device_detect();
if($mobile==true){
  echo"<META HTTP-EQUIV=REFRESH CONTENT='0;URL=mobile/'>";
}else{
	echo"<META HTTP-EQUIV=REFRESH CONTENT='0;URL=logar.php'>";	
}
exit;

?>