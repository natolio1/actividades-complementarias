<?php 

require_once('../conexion/conexion.php');


$cl = isset($_GET['folio']) ? $_GET['folio']: 0;
$de = 'DELETE FROM solicitud WHERE folio = ?';
$statement = $pdo->prepare($de);
$statement -> execute(array($cl));

$carr = $statement->fetchAll();
header('Location: sulicitud_editar.php');

 ?>