<?php
	require_once('../conexion/conexion.php');



	$sql_carrera = 'SELECT * FROM carrera';

	$statement = $pdo->prepare($sql_carrera);
	$statement->execute();
	$campo_carrera = $statement->fetchAll();


	if ($_POST) {
		$sql_insert = 'INSERT INTO estudiante ( No_control, nombre_estudiante, apellido_p_estudiante, apellido_m_estudiante, semestre, carrera_clave ) VALUES( ?, ?, ?, ?, ?, ? )';

  		$noControl = isset($_POST['No_control']) ? $_POST['No_control']: '';

  		$nombreEstudiante = isset($_POST['nombre_estudiante']) ? $_POST['nombre_estudiante']: '';

  		$apellido_p_Estudiante = isset($_POST['apellido_p_estudiante']) ? $_POST['apellido_p_estudiante']: '';

  		$apellido_m_Estudiante = isset($_POST['apellido_m_estudiante']) ? $_POST['apellido_m_estudiante']: '';

  		$semestre = isset($_POST['semestre']) ? $_POST['semestre']: '';

  		$carrera_clave = isset($_POST['carrera_clave']) ? $_POST['carrera_clave']: '';

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($noControl,$nombreEstudiante,$apellido_p_Estudiante, $apellido_m_Estudiante,$semestre,$carrera_clave));
      header('Location: alumnos.php');
	}

	$sql_status = 'SELECT estudiante.*, carrera.nombre_carrera from estudiante INNER JOIN carrera on carrera.clave_carrera = estudiante.carrera_clave WHERE nombre_estudiante LIKE :search ORDER BY nombre_estudiante asc';

 	$search = isset($_GET['nombre_estudiante'])? $_GET['nombre_estudiante']: '';
		$arr[':search']= '%' . $search . '%';

	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute($arr);
	$resultados_tabla = $statement_status->fetchAll();

?>

<?php
	include '../extend/header.php';
 ?>



<div class="container">
	<div class="col s12">
		<h3 class="card-title">Agregar un nuevo estudiante</h3>

			<form method="post" >
						<div class="row">
							<div class="input-field col s12">
          						<input placeholder="Número de control" name="No_control" type="text">
       						</div>
						</div>

						<div class="row">
        					<div class="input-field col s4">
          						<input placeholder="Nombre" name="nombre_estudiante" type="text">
        					</div>
        					<div class="input-field col s4">
          						<input placeholder="Apellido Paterno" name="apellido_p_estudiante" type="text">
        					</div>
        					<div class="input-field col s4">
          						<input placeholder="Apellido Materno" name="apellido_m_estudiante" type="text">
        					</div>
        				</div>

        				<div class="row">
        					<div class="input-field col s12">
    							<select name="semestre">
		      						<option value="" disabled selected>Elige el semestre</option>
		      						<option value="I">I</option>
		  							<option value="II">II</option>
		  							<option value="III">III</option>
		  							<option value="IV">IV</option>
		  							<option value="V">V</option>
		  							<option value="VI">VI</option>
		  							<option value="VII">VII</option>
		  							<option value="VIII">VIII</option>
    							</select>
    							<label>Semestre</label>
  							</div>
        				</div>

        				<div class="row">
        					<div class="input-field col s12">
	                  			<select name="carrera_clave">

	                  				<option value="" disabled selected>Elige la carrera
	                  				</option>

		                  				<?php
						        			foreach($campo_carrera as $rs) {
						        		?>

	  								<option value="<?php echo $rs['clave_carrera']?>"><?php echo $rs['nombre_carrera']?>
	  								</option>

			  							<?php
							          		}
							        	?>
								</select>
								<label>Carrera</label>
							</div>
        				</div>
        			<input class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />

	       	</form>
	</div>

</div>
<div class="container" >
	<div class="col s12">
		<div class="row">
			<a class="btn waves-effect waves-light cyan right" href="alumnos.php">Mostrar todo</a>
			<h3>Estudiantes</h3>
			<table class="striped">

				<thead>
					<tr>
					   	<th>No Control</th>
					   	<th>Nombre</th>
					    <th>Apellido Paterno</th>
						<th>Apellido Materno</th>
					    <th>Semestre</th>
					    <th>Carrera</th>
					</tr>
				</thead>

				<tbody>
				<?php
				   	foreach($resultados_tabla as $rs2) {
				?>
					<tr>
					 	<td><?php echo $rs2['No_control']?></td>
						<td><?php echo $rs2['nombre_estudiante']?></td>
						<td><?php echo $rs2['apellido_p_estudiante']?></td>
						<td><?php echo $rs2['apellido_m_estudiante']?></td>
						<td><?php echo $rs2['semestre']?></td>
						<td><?php echo $rs2['nombre_carrera']?></td>

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
	include '../extend/footer.php';
?>
