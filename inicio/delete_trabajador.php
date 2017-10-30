<?php

require_once('../conexion/conexion.php');

	//actividad
	$clav = isset($_GET['rfc_trabajador']) ? $_GET['rfc_trabajador']: 0;
	$dele = 'DELETE FROM trabajador WHERE rfc_trabajador = ?';
	$statement = $pdo->prepare($dele);
	$statement -> execute(array($clav));

	$r = $statement->fetchAll();
	header('Location: trabajador-editar.php');
?>