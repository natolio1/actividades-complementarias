<?php 
	require_once('../conexion/conexion.php');

	$sql = 'SELECT * FROM trabajador';

	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

if ( $_POST ) {
				
		$insertar = 'INSERT INTO trabajador(rfc_trabajador,nombre_trabajador,apellido_p,apellido_m) VALUES(?,?,?,?)';

		$ac = isset($_POST['rfc_trabajador']) ? $_POST['rfc_trabajador']: '';
		$nombre_depart = isset($_POST['nombre_trabajador']) ? $_POST['nombre_trabajador']: '';
		$p = isset($_POST['apellido_p']) ? $_POST['apellido_p']: '';
		$m = isset($_POST['apellido_m']) ? $_POST['apellido_m']: '';
		
		$statement_insert = $pdo->prepare($insertar);
	  	$statement_insert->execute(array($ac,$nombre_depart,$p,$m));	
}
 ?>

<?php
//Header--------------------------------> 
 	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<div class="row">
			
			<h3 class="card-title">Agregar trabajador</h3>

	    	<form method="post" >
		      	
		      	<div class="row">
					<div class="input-field col s12">
	          		<input placeholder="Rfc del trabajador" name="rfc_trabajador" type="text">
	       			</div>
				</div>

				<div class="row">

				<div class="input-field col s4">
				<input placeholder="Nombre del trabajador" name="nombre_trabajador" type="text">
				</div>
			
			
				<div class="input-field col s4">
				<input placeholder="Apellido paterno" name="apellido_p" type="text">
				</div>
			
			
				<div class="input-field col s4">
				<input placeholder="Apellido Materno" name="apellido_m" type="text">
				</div>	
			</div>
				

				<input class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
				
	    	</form>
		</div>
	</div>
</div>

<div class="container col s12 row">
	<div class="col s12">
		<div class="row">
			
			<h2>Instructor</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Rfc</th>
			       	<th class="center">Nombre</th>
			       	<th class="center">Apellido Paterno</th>
			       	<th class="center">Apellido Materno</th>
			       	
			    </tr>
			</thead>

				<tbody>
					<?php 
						foreach($results as $rs) {
					?>
					<tr>
						<td class="center"><?php echo $rs['rfc_trabajador']?></td>
						<td class="center"><?php echo $rs['nombre_trabajador']?></td>
						<td class="center"><?php echo $rs['apellido_p']?></td>
						<td class="center"><?php echo $rs['apellido_m']?></td>
												

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