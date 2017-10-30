<?php

require_once('../conexion/conexion.php');

?>
<?php

	$miconsulta = 'SELECT * FROM trabajador WHERE nombre_trabajador LIKE :search ORDER BY 	nombre_trabajador asc';

	$search = isset($_GET['nombre_trabajador'])? $_GET['nombre_trabajador']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($miconsulta);
	$statement_status->execute($arr);
	$miresultado = $statement_status->fetchAll();

	$show_form = FALSE;

	
		if($_POST) {

				//TODO:UPDATE ARTICLE
		$sql_update_actividad = 'UPDATE trabajador SET rfc_trabajador = ?,nombre_trabajador = ?,apellido_p = ?,	apellido_m = ? WHERE rfc_trabajador = ?';

			$rfc_in = isset($_GET['rfc_trabajador']) ? $_GET['rfc_trabajador']: '';
			$clave2 = isset($_POST['rfc_trabajador_2']) ? $_POST['rfc_trabajador_2']: '';
		$nombreactividad = isset($_POST['nombre_trabajador']) ? $_POST['nombre_trabajador']: '';
		$apellido_p = isset($_POST['apellido_p']) ? $_POST['apellido_p']: '';
		$apellido_m = isset($_POST['apellido_m']) ? $_POST['apellido_m']: '';
		

			  	$statement_update_details = $pdo->prepare($sql_update_actividad);
			  	$statement_update_details->execute(array($clave2,$nombreactividad,$apellido_p,$apellido_m,$rfc_in));
			  	header('Location: trabajador-editar.php');
		    }

			if( $_GET['rfc_trabajador']) {

				//TODO: GET DETAILS
				$show_form = true;

				

				$sql_update = 'SELECT * FROM trabajador WHERE rfc_trabajador = ?';
				$clave = isset( $_GET['rfc_trabajador']) ? $_GET['rfc_trabajador'] : 0;

				$statement_update = $pdo->prepare($sql_update);
				$statement_update->execute(array($clave));
				$result_details = $statement_update->fetchAll();
				$rs_campo = $result_details[0];
		}

	
	
?>
<?php 
	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<form method="get">
      			<h2 class="card-title">Buscar trabajador</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="nombre_trabajador" class="autocomplete">
         		<label for="autocomplete-input">Ingrese el nombre del departamento</label>
         			<input class="waves-effect waves-light btn cyan" type="submit" value="Buscar">
       			</div>
       		</form>
	</div>
</div>

<?php  
	if ($show_form) {
?>
<div class="container col s12 row">
	<div class="card">
		<div class="card-content">
		<h3 class="card-title">Modificar trabajador</h3>
		<form method="post">

			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['rfc_trabajador'] ?>" type="text" name="rfc_trabajador_2">
				</div>
			</div>

			<div class="row">
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['nombre_trabajador'] ?>" type="text" name="nombre_trabajador">
				</div>
			
			
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['apellido_p'] ?>" type="text" name="apellido_p">
				</div>
			
			
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['apellido_m'] ?>" type="text" name="apellido_m">
				</div>	
			</div>

			<input class="btn waves-effect waves-light" type="submit" value="Modificar">
		</form>	
		</div>
	</div>
</div>

<?php 
	}
 ?>
 <div class="container col s12 row">
	<div class="col s12">
		<div class="row">

			
			<h2 class="card-title">Trabajador</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Rfc</th>
			       	<th class="center">Nombre</th>
			       	<th class="center">Apellido Paterno</th>
			       	<th class="center">Apellido Materno</th>
			       	<th class="center" colspan="2">Acción</th>
			    </tr>
			</thead>

				<tbody>
					<?php 
						foreach($miresultado as $rs) {
					?>
					<tr>
						<td class="center"><?php echo $rs['rfc_trabajador']?></td>
						<td class="center"><?php echo $rs['nombre_trabajador']?></td>
						<td class="center"><?php echo $rs['apellido_p']?></td>
						<td class="center"><?php echo $rs['apellido_m']?></td>
												

						<td class="center">
							<a class="btn waves-effect waves-light cyan lighten-1" href="trabajador-editar.php?rfc_trabajador=<?php echo $rs['rfc_trabajador']; ?>">Editar</a>
						</td>

						<td  class="center">
							<a class="btn waves-effect waves-light red" onclick="delete_tra('<?php echo $rs["rfc_trabajador"]; ?>')" href="#">ELIMINAR</a>
					 	</td>
					 </tr>
					<?php 
					   	}
					?>
				</tbody>
			</table>
		</div>
	</div>			
</div>

 <?php
	include('../extend/footer.php');
?>