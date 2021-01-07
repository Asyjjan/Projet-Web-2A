<?php

try
{
	$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
}
catch( Exception $exception ){
	die($exception->getMessage());
}

?>