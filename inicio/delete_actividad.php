<?php

require_once('../conexion/conexion.php');

	//actividad
	$clav = isset($_GET['clave_act']) ? $_GET['clave_act']: 0;
	$dele = 'delete from act_complementaria where clave_act = ?';
	$statement = $pdo->prepare($dele);
	$statement -> execute(array($clav));

	$r = $statement->fetchAll();
	header('Location: actividadescomplementarias_editar_eliminar.php');
?>