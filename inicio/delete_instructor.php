<?php

require_once('../conexion/conexion.php');

	//actividad
	$clav = isset($_GET['rfc_instructor']) ? $_GET['rfc_instructor']: 0;
	$dele = 'DELETE FROM instructor WHERE rfc_instructor = ?';
	$statement = $pdo->prepare($dele);
	$statement -> execute(array($clav));

	$r = $statement->fetchAll();
	header('Location: instructor_editar.php');
?>