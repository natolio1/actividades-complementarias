<?php 
	require_once('../conexion/conexion.php');

	$sql = 'SELECT departamento.*, trabajador.rfc_trabajador, trabajador.nombre_trabajador,trabajador.apellido_p, trabajador.apellido_m FROM departamento INNER JOIN trabajador ON trabajador.rfc_trabajador = departamento.trabajador_rfc ORDER BY nombre_departamento ASC';

	$statement = $pdo->prepare($sql);
	$statement->execute();
	$results = $statement->fetchAll();

if ( $_POST ) {
				
			$insertar_act = 'INSERT INTO departamento (rfc_departamento,nombre_departamento,trabajador_rfc) VALUES(?,?,?)';

				$ac = isset($_POST['rfc_departamento']) ? $_POST['rfc_departamento']: '';
				$nombre_depart = isset($_POST['nombre_departamento']) ? $_POST['nombre_departamento']: '';

				$clave_tr = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';

				$statement_insert = $pdo->prepare($insertar_act);
			  	$statement_insert->execute(array($ac,$nombre_depart,$clave_tr));
			  	header('Location: departamento.php');
			}

	$sql_status = 'SELECT * FROM trabajador';

	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_datos = $statement_status->fetchAll();

 ?>

<?php
//Header--------------------------------> 
 	include('../extend/header.php');
?>

<div class="container">
	<div class="col s12">
		<h3 >Agregar actividades complementarias</h3>

	    	<form method="post"  >
		      	<div class="row">
					<div class="input-field col s5">
	          			<input placeholder="Rfc del departamento" name="rfc_departamento" type="text">
	       			</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
	          		<input placeholder="Nombre del departamento" name="nombre_departamento" type="text">
	       			</div>
				</div>
				
				<div class="row">
        			<div class="input-field col s12">
	                	<select name="trabajador_rfc">
	                		<option value="" disabled selected>Elige trabajador</option>
		                		<?php 
						    		foreach($results_datos as $rss) {
						       	?>
	  						<option value="<?php echo $rss['rfc_trabajador']?>"><?php echo $rss['nombre_trabajador']?></option>
		  						<?php 
						       		}
						      	?>
						</select>
						<label>Trabajador</label>
					</div>
        		</div>

				<input class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
				
	    	</form>
	</div>
	
</div>

<div class="container">
	<div class="col s12">
		<div class="row">
		
			<h2 class="card-title">Departamento</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Rfc</th>
			       	<th class="center">Departamento</th>
			       	<th class="center">Rfc Trabajador</th>
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
						<td class="center"><?php echo $rs['rfc_departamento']?></td>
						<td class="center"><?php echo $rs['nombre_departamento']?></td>
						<td class="center"><?php echo $rs['trabajador_rfc']?></td>
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