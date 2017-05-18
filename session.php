<?php 


$session = new Session();

if ($session->existe()=='existe') 
{
 
echo "";
    

}
else
{
	header('Location: '.PATH.'');
}


?>
