<?php

require_once('../conexion/conexion.php');
	
	$sql_status = 'SELECT * FROM instituto';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$instituto = $statement_status->fetchAll();

	$sql_status = 'SELECT * FROM instructor';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$instructor = $statement_status->fetchAll();

	$sql_status = 'SELECT * FROM estudiante';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$alumno = $statement_status->fetchAll();

?>
<?php

	$miconsulta = 'SELECT solicitud.*, instituto.nombre_instituto, instructor.nombre_instructor,instructor.apellido_p_instructor, instructor.apellido_m_instructor, instructor.act_complementaria_clave_act, estudiante.nombre_estudiante, estudiante.apellido_p_estudiante, estudiante.apellido_m_estudiante, estudiante.semestre from solicitud INNER JOIN instituto ON instituto.clave_instituto = solicitud.instituto_clave INNER JOIN instructor on instructor.rfc_instructor = solicitud.instructor_rfc INNER JOIN estudiante on estudiante.No_control = solicitud.estudiante_No_contro WHERE estudiante_No_contro LIKE :search ORDER BY folio asc';

	$search = isset($_GET['estudiante_No_contro'])? $_GET['estudiante_No_contro']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($miconsulta);
	$statement_status->execute($arr);
	$miresultado = $statement_status->fetchAll();

	$show_form = FALSE;

	
		if($_POST) {

				//TODO:UPDATE ARTICLE
		$sql_update_actividad = 'UPDATE solicitud SET folio = ?, asunto = ?,fecha = ?,lugar = ?,	instituto_clave = ?, instructor_rfc = ?, estudiante_No_contro = ? WHERE folio = ?';

		$rfc_in = isset($_GET['folio']) ? $_GET['folio']: '';
		$clave2 = isset($_POST['folio_2']) ? $_POST['folio_2']: '';
		$nombreactividad = isset($_POST['asunto']) ? $_POST['asunto']: '';
		$nombreactividad2 = isset($_POST['fecha']) ? $_POST['fecha']: '';
		$apell = isset($_POST['lugar']) ? $_POST['lugar']: '';
		$apel = isset($_POST['instituto_clave']) ? $_POST['instituto_clave']: '';
		$ape = isset($_POST['instructor_rfc']) ? $_POST['instructor_rfc']: '';
		$ap = isset($_POST['estudiante_No_contro']) ? $_POST['estudiante_No_contro']: '';
		

			  	$statement_update_details = $pdo->prepare($sql_update_actividad);
			  	$statement_update_details->execute(array($clave2,$nombreactividad,$nombreactividad2,$apell,$apel,$ape,$ap,$rfc_in));
			  	header('Location: sulicitud_editar.php');
		    }

			if( $_GET['folio']) {

				//TODO: GET DETAILS
				$show_form = true;

				$sql_update = 'SELECT solicitud.*, instituto.nombre_instituto, instructor.nombre_instructor,instructor.apellido_p_instructor, instructor.apellido_m_instructor, instructor.act_complementaria_clave_act, estudiante.nombre_estudiante, estudiante.apellido_p_estudiante, estudiante.apellido_m_estudiante,estudiante.No_control, estudiante.semestre from solicitud INNER JOIN instituto ON instituto.clave_instituto = solicitud.instituto_clave INNER JOIN instructor on instructor.rfc_instructor = solicitud.instructor_rfc INNER JOIN estudiante on estudiante.No_control = solicitud.estudiante_No_contro WHERE folio = ?';
				$clave = isset( $_GET['folio']) ? $_GET['folio'] : 0;

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
      			<h2 class="card-title">Buscar solicitud</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="estudiante_No_contro" class="autocomplete">
         		<label for="autocomplete-input">Ingrese el nombre del departamento</label>
         			<input class="waves-effect waves-light btn cyan" type="submit" value="Buscar">
       			</div>
       		</form>
	</div>
</div>.

<?php  
	if ($show_form) {
?>
<div class="container">
	<div class="col s12">
		<div class="row">
		<h3>Modificar solicitud</h3>
		<form method="post">

			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['folio'] ?>" type="text" name="folio_2">
				</div>
			</div>

			<div class="row">
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['asunto'] ?>" type="text" name="asunto">
				</div>
			
			
				<div class="input-field col s4">
					<input value="<?php echo $rs_campo['lugar'] ?>" type="text" name="lugar">
				</div>
			
				
	        	<div class="input-field col s4">

	            	<select name="instituto_clave">
	                	<option value="" disabled selected>Elige Instituto</option>
	                	<?php 
					   		foreach($instituto as $rl) {
					   	?>
	  					<option value="<?php echo $rl['clave_instituto']?>" <?php $selected = ($rs_campo['nombre_instituto'] == $rl['nombre_instituto'])?"SELECTED":""; echo $selected?>><?php echo $rl['nombre_instituto']?></option>
	  					<?php 
					   		}
					   	?>
					</select>
					<label>Instituto</label>
				</div>
			</div>

			<div class="row">
        		<div class="input-field col s4">

	            		<select name="instructor_rfc">
	                		<option value="" disabled selected>Elige Instituto</option>
	                		<?php 
					    		foreach($instructor as $rl) {
					    	?>
	  						<option value="<?php echo $rl['rfc_instructor']?>" <?php $selected = ($rs_campo['nombre_instructor'] == $rl['nombre_instructor'])?"SELECTED":""; echo $selected?>><?php echo $rl['nombre_instructor']?></option>
	  						<?php 
					    		}
					    	?>
						</select>
						<label>Instructor</label>
					</div>
				

				<div class="input-field col s4">

	            		<select name="estudiante_No_contro">
	                		<option value="" disabled selected>Elige Estudiante</option>
	                		<?php 
					    		foreach($alumno as $rl) {
					    	?>
	  						<option value="<?php echo $rl['No_control']?>" <?php $selected = ($rs_campo['No_control'] == $rl['No_control'])?"SELECTED":""; echo $selected?>><?php echo $rl['No_control']?></option>
	  						<?php 
					    		}
					    	?>
						</select>
						<label>Estudiante</label>
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

 <div class="row">
    <div class="col s12">
    <h3 class="card-title">Datos solicitud</h3>
    <table class="responsive-table">
	    <thead>
           	<tr>
	            <th>Instituto</th>
				<th>Folio</th>
				<th>Asunto</th>
				<th>Fecha</th>
				<th>Lugar</th>
				<th>Instructor</th>
				<th>No control</th>
            </tr>
        </thead>
        
        <tbody>
        	<?php 
		   		foreach($miresultado as $rs) {
		   	?>
                
            <tr>
            	<td><?php echo $rs['nombre_instituto']?></td>
				<td><?php echo $rs['folio']?></td>
				<td><?php echo $rs['asunto']?></td>
				<td><?php echo $rs['fecha']?></td>
				<td><?php echo $rs['lugar']?></td>
				<td><?php echo $rs['instructor_rfc'] ?></td>
				<td><?php echo $rs['estudiante_No_contro'] ?></td>

				<td class="center">
					<a class="btn waves-effect waves-light cyan lighten-1" href="sulicitud_editar.php?folio=<?php echo $rs['folio']; ?>">Editar</a>
				</td>

				<td  class="center">
					<a class="btn waves-effect waves-light red" onclick="delete_solicitud('<?php echo $rs["folio"]; ?>')" href="#">ELIMINAR</a>
				</td>

            </tr>
            <?php 
			   	}
			?>
    	</tbody>
    	</table>
	</div>
</div>
<?php

 include('../extend/footer.php');

 ?>
