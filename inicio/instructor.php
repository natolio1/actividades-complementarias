<?php

require_once('../conexion/conexion.php');

?>

<?php

	$miconsulta = 'SELECT instructor.*, act_complementaria.nombre_complementarias FROM instructor INNER JOIN act_complementaria ON act_complementaria.clave_act = instructor.act_complementaria_clave_act ORDER BY nombre_instructor asc';

	$statement_status = $pdo->prepare($miconsulta);
	$statement_status->execute();
	$miresultado = $statement_status->fetchAll();

	
	$sql_status = 'SELECT * FROM act_complementaria';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_datos = $statement_status->fetchAll();

	if ($_POST) {
		
		$insertar = 'INSERT INTO instructor(rfc_instructor,nombre_instructor,apellido_p_instructor,apellido_m_instructor,act_complementaria_clave_act) VALUES(?,?,?,?,?)';

		$ac = isset($_POST['rfc_instructor']) ? $_POST['rfc_instructor']: '';
		$nombre_depart = isset($_POST['nombre_instructor']) ? $_POST['nombre_instructor']: '';
		$p = isset($_POST['apellido_p_instructor']) ? $_POST['apellido_p_instructor']: '';
		$m = isset($_POST['apellido_m_instructor']) ? $_POST['apellido_m_instructor']: '';
		$act = isset($_POST['act_complementaria_clave_act']) ? $_POST['act_complementaria_clave_act']: '';

		$statement_insert = $pdo->prepare($insertar);
	  	$statement_insert->execute(array($ac,$nombre_depart,$p,$m,$act));
	  	header('Location: instructor.php');
	}

	
?>


<?php 
	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<h3 class="card-title">Agregar Instructor</h3>

	    	<form method="post" >
		      	
		      	<div class="row">
					<div class="input-field col s5">
	          		<input placeholder="Rfc del departamento" name="rfc_instructor" type="text">
	       			</div>
				</div>

				<div class="row">

				<div class="input-field col s4">
				<input placeholder="Nombre del instructor" name="nombre_instructor" type="text">
				</div>
			
			
				<div class="input-field col s4">
				<input placeholder="Apellido paterno" name="apellido_p_instructor" type="text">
				</div>
			
			
				<div class="input-field col s4">
				<input placeholder="Apellido Materno" name="apellido_m_instructor" type="text">
				</div>	
			</div>
				<div class="row">
        			<div class="input-field col s12">
	                	<select name="act_complementaria_clave_act">
	                		<option value="" disabled selected>Elige instructor</option>
		                		<?php 
						    		foreach($results_datos as $rss) {
						       	?>
	  						<option value="<?php echo $rss['clave_act']?>"><?php echo $rss['nombre_complementarias']?></option>
		  						<?php 
						       		}
						      	?>
						</select>
						<label>Actividad complementaria</label>
					</div>
        		</div>

				<input class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
				
	    	</form>
	</div>
</div>


<div class="container col s12 row">
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