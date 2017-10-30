<?php 
	require_once('../conexion/conexion.php');

	$sql = 'SELECT * FROM carrera';

	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

if ( $_POST ) {
				
				$insertar_act = 'INSERT INTO carrera (clave_carrera,nombre_carrera) VALUES(?,?)';

				$act_clave = isset($_POST['clave_carrera']) ? $_POST['clave_carrera']: '';
				$nombre_complementarias = isset($_POST['nombre_carrera']) ? $_POST['nombre_carrera']: '';

				$statement_insert = $pdo->prepare($insertar_act);
			  	$statement_insert->execute(array($act_clave,$nombre_complementarias));	
			}
 ?>


<?php
//Header--------------------------------> 
 	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<h3>Agregar una nueva carrera</h3>
	    	<form method="post" class="col s5">
		      	<div class="row">
					<div class="input-field col s5">
	          			<input placeholder="Clave de la carrera." name="clave_carrera" type="text">
	       			</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
	          		<input placeholder="Nombre de la carrera" name="nombre_carrera" type="text">
	       			</div>
				</div>
				<input  name="boton" class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
	    	</form>			
	</div>
</div>
	<br>

<div class="container">
	<div class="col s12" >
		<div class="row">
			<h3>Carreras</h3>
			
			<table class="striped">
				<thead>
					<tr>
					   	<th class="center">Clave</th>
					   	<th class="center">Nombre de la carrera</th>
					   
					</tr>
				</thead>

				<tbody>
					<?php 
					   	foreach($results as $rs2) {
					?>
						<tr>
						 	<td class="center"><?php echo $rs2['clave_carrera']?></td>
							<td class="center"><?php echo $rs2['nombre_carrera']?></td>
							
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
  include('../extend/footer.php')
?>