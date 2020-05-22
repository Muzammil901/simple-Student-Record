<?php

$db_hostname = "localhost";
$db_name = "crudp2";
$username = "user1";
$password = "admin";

try{
$con = new PDO("mysql:host={$db_hostname}; dbname={$db_name}", $username, $password);}

catch(PDOexception $ex){
	die('Error: ' . $ex->getMessage());
}

?>