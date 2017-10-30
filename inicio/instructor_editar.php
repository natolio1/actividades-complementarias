<?php

require_once('../conexion/conexion.php');

?>

<?php

	$miconsulta = 'SELECT instructor.*, act_complementaria.nombre_complementarias FROM instructor INNER JOIN act_complementaria ON act_complementaria.clave_act = instructor.act_complementaria_clave_act WHERE nombre_instructor LIKE :search ORDER BY nombre_instructor asc';

	$search = isset($_GET['nombre_instructor'])? $_GET['nombre_instructor']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($miconsulta);
	$statement_status->execute($arr);
	$miresultado = $statement_status->fetchAll();

	$show_form = FALSE;
	

	//modificar--------------------------------------->
		if($_POST) {

				//TODO:UPDATE ARTICLE
		$sql_update_actividad = 'UPDATE instructor SET rfc_instructor = ?,nombre_instructor = ?,apellido_p_instructor = ?,apellido_m_instructor = ?,act_complementaria_clave_act = ? WHERE rfc_instructor = ?';

			$rfc_in = isset($_GET['rfc_instructor']) ? $_GET['rfc_instructor']: '';
			$clave2 = isset($_POST['rfc_instructor_2']) ? $_POST['rfc_instructor_2']: '';
		$nombreactividad = isset($_POST['nombre_instructor']) ? $_POST['nombre_instructor']: '';
		$apellido_p = isset($_POST['apellido_p_instructor']) ? $_POST['apellido_p_instructor']: '';
		$apellido_m = isset($_POST['apellido_m_instructor']) ? $_POST['apellido_m_instructor']: '';
		$rfc = isset($_POST['act_complementaria_clave_act']) ? $_POST['act_complementaria_clave_act']: '';

			  	$statement_update_details = $pdo->prepare($sql_update_actividad);
			  	$statement_update_details->execute(array($clave2,$nombreactividad,$apellido_p,$apellido_m,$rfc,$rfc_in));
			  	header('Location: instructor_editar.php');
		    }

			if( $_GET['rfc_instructor']) {

				//TODO: GET DETAILS
				$show_form = true;
			
				

				$sql_update = 'SELECT instructor.*, act_complementaria.nombre_complementarias FROM instructor INNER JOIN act_complementaria ON act_complementaria.clave_act = instructor.act_complementaria_clave_act WHERE rfc_instructor = ?';
				$clave = isset( $_GET['rfc_instructor']) ? $_GET['rfc_instructor'] : 0;

				$statement_update = $pdo->prepare($sql_update);
				$statement_update->execute(array($clave));
				$result_details = $statement_update->fetchAll();
				$rs_campo = $result_details[0];
		}

	$sql_status = 'SELECT * FROM act_complementaria';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_datos = $statement_status->fetchAll();

	
?>

<?php 
	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<form method="get">
      			<h2 class="card-title">Buscador de instructor</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="nombre_instructor" class="autocomplete">
         		<label for="autocomplete-input">Ingrese el nombre de instructor</label>
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
		<h3 class="card-title">Modificar instructor</h3>
		<form method="post">

			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['rfc_instructor'] ?>" type="text" name="rfc_instructor_2">
				</div>
			</div>

			<div class="row">
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['nombre_instructor'] ?>" type="text" name="nombre_instructor">
				</div>
			
			
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['apellido_p_instructor'] ?>" type="text" name="apellido_p_instructor">
				</div>
			
			
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['apellido_m_instructor'] ?>" type="text" name="apellido_m_instructor">
				</div>	
			</div>

			<div class="row">
        		<div class="input-field col s12">
	                <select name="act_complementaria_clave_act">
	                	<option value="" disabled selected>Eliga actividad complementaria</option>
	                	<?php 
							foreach($results_datos as $rs) {
						?>
	  					<option value="<?php echo $rs['clave_act']?>" <?php $selected = ($rs_campo['nombre_complementarias'] == $rs['nombre_complementarias'])?"SELECTED":""; echo $selected?>><?php echo $rs['nombre_complementarias']?></option>
	  					<?php 
					    	}
					    ?>
					</select>
				<label>Actividad complementaria</label>
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

 <div class="container">
	<div class="col s12">
		<div class="row">

		
			
			<h2 class="card-title">Instructor</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Rfc</th>
			       	<th class="center">Nombre</th>
			       	<th class="center">Apellido Paterno</th>
			       	<th class="center">Apellido Materno</th>
			       	<th class="center">Actividad complementaria</th>
			       	<th class="center" colspan="2">Acción</th>
			    </tr>
			</thead>

				<tbody>
					<?php 
						foreach($miresultado as $rs) {
					?>
					<tr>
						<td class="center"><?php echo $rs['rfc_instructor']?></td>
						<td class="center"><?php echo $rs['nombre_instructor']?></td>
						<td class="center"><?php echo $rs['apellido_p_instructor']?></td>
						<td class="center"><?php echo $rs['apellido_m_instructor']?></td>
						<td class="center"><?php echo $rs['nombre_complementarias']?></td>
						

						<td class="center">
							<a class="btn waves-effect waves-light cyan lighten-1" href="instructor_editar.php?rfc_instructor=<?php echo $rs['rfc_instructor']; ?>">Editar</a>
						</td>

						<td  class="center">
							<a class="btn waves-effect waves-light red" onclick="delete_instruc('<?php echo $rs["rfc_instructor"]; ?>')" href="#">ELIMINAR</a>
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