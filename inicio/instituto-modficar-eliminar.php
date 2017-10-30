<?php 
	require_once('../conexion/conexion.php');


	$institut = 'SELECT * from instituto WHERE nombre_instituto LIKE :search ORDER BY 	nombre_instituto ASC';

	$search = isset($_GET['nombre_instituto'])? $_GET['nombre_instituto']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($institut);
	$statement_status->execute($arr);
	$RESULT= $statement_status->fetchAll();

	$show_form = FALSE;
	
	
		if($_POST) {

				//TODO:UPDATE ARTICLE
				$sql_update_actividad = 'UPDATE instituto SET clave_instituto = ?, 	nombre_instituto = ? WHERE clave_instituto = ?';

				$rfc_d = isset($_GET['clave_instituto']) ? $_GET['clave_instituto']: '';
				$clave2 = isset($_POST['clave_instituto_2']) ? $_POST['clave_instituto_2']: '';
				$nombreactividad= isset($_POST['nombre_instituto']) ? $_POST['nombre_instituto']: '';

			  	$statement_update_details = $pdo->prepare($sql_update_actividad);
			  	$statement_update_details->execute(array($clave2,$nombreactividad,$rfc_d));
			  	header('Location: instituto-modficar-eliminar.php');
		    }

			if(( $_GET['clave_instituto'] )) {

				//TODO: GET DETAILS
				$show_form = true;
				
				

				$sql_update = 'SELECT * FROM instituto WHERE clave_instituto = ?';
				$clave = isset( $_GET['clave_instituto']) ? $_GET['clave_instituto'] : 0;

				$statement_update = $pdo->prepare($sql_update);
				$statement_update->execute(array($clave));
				$result_details = $statement_update->fetchAll();
				$rs_campo = $result_details[0];
		}

?>

<?php 
	include('../extend/header.php');
 ?>
<br>
	<div class="container">
		<div class="col s12">
			<form method="get">
      			<h2 class="card-title">Buscador de departamento</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="nombre_instituto" class="autocomplete">
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
	<div class="col s12">
		<div class="row">
		<h3>Modificar actividad complementaria</h3>
		<form method="post">
			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['clave_instituto'] ?>" type="text" name="clave_instituto_2">
				</div>
			</div>
			<div class="row">
				<div class="input-field col s5">
					<input value="<?php echo $rs_campo['nombre_instituto'] ?>" type="text" name="nombre_instituto">
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


<!--tabla-->
<div class="container col s12 row">
	<div class="card">
		<div class="card-content">
						
			<h2 class="card-title">Departamento</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Clave</th>
			       	<th class="center">Nombre</th>
			       	<th class="center" colspan="2">Acción</th>
			    </tr>
			</thead>

				<tbody>
					<?php 
						foreach($RESULT as $rs) {
					?>
					<tr>
						<td class="center"><?php echo $rs['clave_instituto']?></td>
						<td class="center"><?php echo $rs['nombre_instituto']?></td>
						
						<td class="center">
							<a class="btn waves-effect waves-light cyan lighten-1" href="instituto-modficar-eliminar.php?clave_instituto=<?php echo $rs['clave_instituto']; ?>">Editar</a>
						</td>

						<td  class="center">
							<a class="btn waves-effect waves-light red" onclick="delete_insti('<?php echo $rs["clave_instituto"]; ?>')" href="#">ELIMINAR</a>
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
