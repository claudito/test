<?php 

include('../autoload.php');

$name =  addslashes(trim($_POST['name']));
$pwd  =  addslashes(trim($_POST['pwd']));

if (empty($name))
 {
   echo "emptyname";
 }
 else if (empty($pwd))
 {
   echo "emptypwd";
 }
 else if (empty($name) AND empty($pwd))
 {
   echo "emptynamepwd";
 }
 else
 {
 	$acceso =  new Acceso($name,md5($pwd));
    echo $acceso -> Login();

 }





 ?>