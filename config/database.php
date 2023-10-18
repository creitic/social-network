<?php 

//var_dump(PDO::getAvailableDrivers());
define('DB_HOST', 'localhost');
define('DB_NAME', 'reseau');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

try{
	$db=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	die('Erreur: '.$e->getMessage());
}

//ALTER TABLE users ADD COLUMN created_at datetime DEFAULT NOW();
//truncate users : supprime les contenu users