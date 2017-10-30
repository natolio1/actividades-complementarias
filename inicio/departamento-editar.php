<?php

require_once('../conexion/conexion.php');


	$miconsulta = 'SELECT departamento.*, trabajador.rfc_trabajador, trabajador.nombre_trabajador,trabajador.apellido_p, trabajador.apellido_m FROM departamento INNER JOIN trabajador ON trabajador.rfc_trabajador = departamento.trabajador_rfc WHERE nombre_departamento LIKE :search ORDER BY nombre_departamento ASC';

	$search = isset($_GET['nombre_departamento'])? $_GET['nombre_departamento']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($miconsulta);
	$statement_status->execute($arr);
	$miresultado = $statement_status->fetchAll();

	$show_form = FALSE;
	
	


		if($_POST) {

				//TODO:UPDATE ARTICLE
				$sql_update_actividad = 'UPDATE departamento SET rfc_departamento = ?, nombre_departamento= ?, trabajador_rfc = ? WHERE rfc_departamento = ?';

				$rfc_d = isset($_GET['rfc_departamento']) ? $_GET['rfc_departamento']: '';
				$clave2 = isset($_POST['rfc_departamento_2']) ? $_POST['rfc_departamento_2']: '';
				$nombreactividad= isset($_POST['nombre_departamento']) ? $_POST['nombre_departamento']: '';
				$rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';

			  	$statement_update_details = $pdo->prepare($sql_update_actividad);
			  	$statement_update_details->execute(array($clave2,$nombreactividad,$rfc,$rfc_d));
			  	header('Location: departamento-editar.php');
		    }

			if(( $_GET['rfc_departamento'] )) {

				//TODO: GET DETAILS
				$show_form = true;
				
				

				$sql_update = 'SELECT departamento.*, trabajador.rfc_trabajador, trabajador.nombre_trabajador,trabajador.apellido_p, trabajador.apellido_m FROM departamento INNER JOIN trabajador ON trabajador.rfc_trabajador = departamento.trabajador_rfc WHERE rfc_departamento = ?';
				$clave = isset( $_GET['rfc_departamento']) ? $_GET['rfc_departamento'] : 0;

				$statement_update = $pdo->prepare($sql_update);
				$statement_update->execute(array($clave));
				$result_details = $statement_update->fetchAll();
				$rs_campo = $result_details[0];
		}

	

	$sql_status = 'SELECT * FROM trabajador';

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
      			<h2 class="card-title">Buscador de departamento</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="nombre_departamento" class="autocomplete">
         		<label for="autocomplete-input">Ingrese el nombre del departamento</label>
         			<input class="waves-effect waves-light btn cyan" type="submit" value="Buscar">
       			</div>
       		</form>
 	</div>
 	
 </div>

 <?php  
	if ($show_form) {
?>
<div class="container">
	<div class="col s12">
		<div class="row">
		<h3 class="card-title">Modificar departamento</h3>
		<form method="post">
			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['rfc_departamento'] ?>" type="text" name="rfc_departamento_2">
				</div>
			</div>
			<div class="row">
				<div class="input-field col s5">
					<input value="<?php echo $rs_campo['nombre_departamento'] ?>" type="text" name="nombre_departamento">
				</div>
			</div>
			<div class="row">
        		<div class="input-field col s12">
	                <select name="trabajador_rfc">
	                	<option value="" disabled selected>Eliga trabajador</option>
	                	<?php 
							foreach($results_datos as $rs) {
						?>
	  					<option value="<?php echo $rs['rfc_trabajador']?>" <?php $selected = ($rs_campo['nombre_trabajador'] == $rs['nombre_trabajador'])?"SELECTED":""; echo $selected?>><?php echo $rs['nombre_trabajador']?></option>
	  					<?php 
					    	}
					    ?>
					</select>
				<label>Trabajador</label>
				</div>
        	</div>
			<input class="btn waves-effect waves-light" type="submit" value="Modificar">
			<input class="btn waves-effect waves-light" type="submit" value = "Cancelar" onClick ="departamento.php">
		</form>	
		</div>
	</div>
</div>

<?php 
	}
 ?>

 <div class="container ">
	<div class="col s12">
		<div class="row">

					
			<h2 >Departamento</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Rfc</th>
			       	<th class="center">Departamento</th>
			       	<th class="center">Rfc Trabajador</th>
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
						<td class="center"><?php echo $rs['rfc_departamento']?></td>
						<td class="center"><?php echo $rs['nombre_departamento']?></td>
						<td class="center"><?php echo $rs['trabajador_rfc']?></td>
						<td class="center"><?php echo $rs['nombre_trabajador']?></td>
						<td class="center"><?php echo $rs['apellido_p']?></td>
						<td class="center"><?php echo $rs['apellido_m']?></td>

						<td class="center">
							<a class="btn waves-effect waves-light cyan lighten-1" href="departamento-editar.php?rfc_departamento=<?php echo $rs['rfc_departamento']; ?>">Editar</a>
						</td>

						<td  class="center">
							<a class="btn waves-effect waves-light red" onclick="delete_depe('<?php echo $rs["rfc_departamento"]; ?>')" href="#">ELIMINAR</a>
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