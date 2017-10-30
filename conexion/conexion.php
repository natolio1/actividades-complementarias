<?php

	$con = 'mysql:dbname=universidaa;host=localhost';
	$user = 'natolio';
	$password = 'nato1234';

	try {
		$pdo = new PDO($con,$user,$password);
	} catch (Exception $e) {
		echo 'Error al conectarnos' .$e->getMessage();
	}

 ?>
