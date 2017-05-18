<?php 

class Session
{


function __construct()
{

}


function existe()
{

 session_start();

  if (isset($_SESSION[KEY.USUARIO])) 
  {
  	return "existe";
  }
	
}




}




 ?>