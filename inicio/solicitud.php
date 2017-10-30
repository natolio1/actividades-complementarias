<?php

require_once('../conexion/conexion.php');

	$mi = 'SELECT solicitud.*, instituto.nombre_instituto, instructor.nombre_instructor,instructor.apellido_p_instructor, instructor.apellido_m_instructor, instructor.act_complementaria_clave_act, estudiante.nombre_estudiante, estudiante.apellido_p_estudiante, estudiante.apellido_m_estudiante, estudiante.semestre from solicitud INNER JOIN instituto ON instituto.clave_instituto = solicitud.instituto_clave INNER JOIN instructor on instructor.rfc_instructor = solicitud.instructor_rfc INNER JOIN estudiante on estudiante.No_control = solicitud.estudiante_No_contro';

	$statement_status = $pdo->prepare($mi);
	$statement_status->execute();
	$miresultado = $statement_status->fetchAll();


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


	if ($_POST) {
		
		$insertar = 'INSERT INTO solicitud(folio,asunto,fecha,lugar,instituto_clave,instructor_rfc,estudiante_No_contro) VALUES(?,?,?,?,?,?,?)';

		$ac = isset($_POST['folio']) ? $_POST['folio']: '';
		$nombre_depart = isset($_POST['asunto']) ? $_POST['asunto']: '';
		$p = isset($_POST['fecha']) ? $_POST['fecha']: '';
		$m = isset($_POST['lugar']) ? $_POST['lugar']: '';
		$act = isset($_POST['instituto_clave']) ? $_POST['instituto_clave']: '';
		$ar = isset($_POST['instructor_rfc']) ? $_POST['instructor_rfc']: '';
		$a = isset($_POST['estudiante_No_contro']) ? $_POST['estudiante_No_contro']: '';

		$statement_insert = $pdo->prepare($insertar);
	  	$statement_insert->execute(array($ac,$nombre_depart,$p,$m,$act,$ar,$a));
	  	header('Location: solicitud.php');
	}

?>

<?php 
	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<h3>Agregar una nueva carrera</h3>
	    	<form method="post" class="col s5">
		      	<div class="row">
					<div class="input-field col s12">
	          			<input placeholder="Folio" name="folio" type="text">
	       			</div>
				</div>

				<div class="row">
					<div class="input-field col s4">
	          		<input placeholder="Asunto" name="asunto" type="text">
	       			</div>
				
					<div class="input-field col s4">
	          		<input placeholder="Lugar" name="lugar" type="text">
	       			</div>

	       			<div class="input-field col s4">
	                	<select name="instituto_clave">
	                	<option value="" disabled selected>Eliga Instituto</option>
	                	<?php 
							foreach($instituto as $rl) {
						?>
	  					<option value="<?php echo $rl['clave_instituto']?>"><?php echo $rl['nombre_instituto']?>	
	  								</option>
	  					<?php 
					    	}
					    ?>
						</select>
						<label>Instituto</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s5">
		              	<select name="instructor_rfc">
			               	<option value="" disabled selected>Eliga Instructor</option>
			               	<?php 
								foreach($instructor as $rl) {
							?>
			  				<option value="<?php echo $rl['rfc_instructor']?>"><?php echo $rl['nombre_instructor']?>	
	  								</option>
			  				<?php 
						    	}
						    ?>
						</select>
						<label>Instructor</label>
					</div>
				
					<div class="input-field col s5">
		               	<select name="estudiante_No_contro">
		                	<option value="" disabled selected>Eliga Estudiante</option>
		                	<?php 
								foreach($alumno as $rl) {
							?>
		  					<option value="<?php echo $rl['No_control']?>"><?php echo $rl['No_control']?>	
	  								</option>
		  					<?php 
						    	}
						    ?>
						</select>
						<label>Estudiante</label>
						</div>
					</div>
				<input  name="boton" class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
	    	</form>			
	</div>
</div>


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
				<th>Rfc</th>
				<th>Instructor</th>
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
				<td> <?php echo $rs['estudiante_No_contro'] ?></td>
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