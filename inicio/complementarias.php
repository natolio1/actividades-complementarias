<?php 
	require_once('../conexion/conexion.php');

	$sql = 'SELECT * FROM act_complementaria';

	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

if ($_POST) {
	

	$sql_insert = 'INSERT INTO act_complementaria ( clave_act, nombre_complementarias) VALUES( ?, ?)';

  		$clave = isset($_POST['clave_act']) ? $_POST['clave_act']: '';

  		$nombre = isset($_POST['nombre_complementarias']) ? $_POST['nombre_complementarias']: '';

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($clave,$nombre));
      
  	}
 ?>


<?php
//Header--------------------------------> 
 	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<h3>Agregar actividades complementarias</h3>
	    	<form method="post" class="col s5">
		      	<div class="row">
					<div class="input-field col s5">
	          			<input placeholder="Clave de la actividad complementaria." name="clave_act" type="text">
	       			</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
	          		<input placeholder="Nombre de la actividad complementaria." name="nombre_complementarias" type="text">
	       			</div>
				</div>
				<input  name="boton" class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
	    	</form>	
	</div>
	<br>
</div>
			
<div class="container">
	<div class="col s12">
<hr>
<br>
		<table class="striped">
				<thead>
					<tr>
					   	<th>Clave</th>
					   	<th>Nombre de complementarias</th>
					    
					</tr>
				</thead>

				<tbody>
					<?php 
					   	foreach($results as $rs2) {
					?>
						<tr>
						 	<td><?php echo $rs2['clave_act']?></td>
							<td><?php echo $rs2['nombre_complementarias']?></td>
							
						</tr>
					<?php 
						}
					?>
				</tbody>
			</table>
	</div>
</div>


<?php 
  include('../extend/footer.php')
?>