<?php

require_once('../conexion/conexion.php');

	//actividad
	$clav = isset($_GET['rfc_departamento']) ? $_GET['rfc_departamento']: 0;
	$dele = 'delete from departamento where rfc_departamento = ?';
	$statement = $pdo->prepare($dele);
	$statement -> execute(array($clav));

	$r = $statement->fetchAll();
	header('Location: departamento-editar.php');
?>