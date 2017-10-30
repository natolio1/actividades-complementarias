<?php 

require_once('../conexion/conexion.php');


$cl = isset($_GET['clave_carrera']) ? $_GET['clave_carrera']: 0;
$de = 'DELETE FROM carrera WHERE clave_carrera = ?';
$statement = $pdo->prepare($de);
$statement -> execute(array($cl));

$carr = $statement->fetchAll();
header('Location: modicaryeliminarcarrera.php');

 ?>