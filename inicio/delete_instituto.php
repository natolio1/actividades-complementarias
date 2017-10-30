<?php 

require_once('../conexion/conexion.php');

$noControl = isset($_GET['clave_instituto']) ? $_GET['clave_instituto'] : 0 ;
$sql = 'DELETE FROM instituto WHERE clave_instituto = ?';

$statement = $pdo->prepare($sql);
$statement->execute(array($noControl));

$results = $statement->fetchAll();
header('Location: instituto-modficar-eliminar.php');


 ?>