<?php

	$user 	= 'root';
	$pass 	= '';
	$dbname	= 'dicobat';
	$host	='localhost';

	try {
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	}catch(PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}

?>