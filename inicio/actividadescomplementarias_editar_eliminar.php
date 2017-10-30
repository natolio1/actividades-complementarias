<?php 
	require_once('../conexion/conexion.php');

		
		$sql = 'SELECT * FROM act_complementaria WHERE nombre_complementarias LIKE :search ORDER by clave_act ASC';
		$search = isset($_GET['nombre_complementarias'])? $_GET['nombre_complementarias']: '';
		$arr[':search']= '%' . $search . '%';
		$statement = $pdo->prepare($sql);
		$statement->execute($arr);
		$results = $statement->fetchAll();

		$show_form = FALSE;
		$show_form2 = false;
		$show_form3 = true;	


if($_POST) {

	//TODO:UPDATE ARTICLE
	$sql_update_actividad = 'UPDATE act_complementaria SET clave_act = ?, nombre_complementarias = ? WHERE clave_act = ?';

	$clave = isset($_GET['clave_act']) ? $_GET['clave_act']: '';
	$clave2 = isset($_POST['clave_act_2']) ? $_POST['clave_act_2']: '';
	$nombreactividad= isset($_POST['nombre_complementarias']) ? $_POST['nombre_complementarias']: '';
  	$statement_update_details = $pdo->prepare($sql_update_actividad);
  	$statement_update_details->execute(array($clave2,$nombreactividad,$clave));
  	header('Location: actividadescomplementarias_editar_eliminar.php');
}

	if(isset( $_GET['clave_act'] ) ) {

		//TODO: GET DETAILS
		$show_form = true;
		$show_form2 = false;
		$show_form3 = false;

		$sql_update = 'SELECT * from act_complementaria WHERE clave_act = ?';
		$clave = isset( $_GET['clave_act']) ? $_GET['clave_act'] : 0;
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
<div class="container col s12 ">
	<form method="get">
        			<div class="input-field ">
        				<div class="col s7">
        					<input type="text" id="autocomplete-input" name="nombre_complementarias" class="autocomplete">
	         			<label for="autocomplete-input">Buscar</label>

        				</div>
	         			
	         			<div class="right">
	         				<input class="waves-effect waves-light btn cyan" type="submit" value="Buscar" >
	         			</div>
       				</div>
       			</form>
</div>


<?php  
	if ($show_form) {
?>
<div class="container col s12 row">
	<div class="card">
		<div class="card-content">
		<h3 class="card-title">Modificar actividad complementaria</h3>
		<form method="post">
			<div class="row">
				<div class="input-field col s12">
					<input value="<?php echo $rs_campo['clave_act'] ?>" type="text" name="clave_act_2">
				</div>
			</div>
			<div class="row">
				<div class="input-field col s5">
					<input value="<?php echo $rs_campo['nombre_complementarias'] ?>" type="text" name="nombre_complementarias">
				</div>
			</div>
			<input class="btn waves-effect waves-light" type="submit" value="Modificar">
			<input class="btn waves-effect waves-light" type="submit" value = "Cancelar" onClick =" actividad.php">
		</form>	
		</div>
	</div>
</div>

<?php 
	}
 ?>
 <br>

	<div class="col s12 container">
		<div class="row">
	
					
			<br>
			<h3 >Actividades complementarias</h3>
			
			<table >
				<thead>
					<tr>
					   	<th class="center">Clave</th>
					   	<th class="center">Nombre de complementarias</th>
					    <th class="center" colspan="2">Acción</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					   	foreach($results as $rs2) {
					?>
						<tr>
						 	<td class="center"><?php echo $rs2['clave_act']?></td>
							<td class="center"><?php echo $rs2['nombre_complementarias']?></td>
							
							<td class="center">
								<a class="btn waves-effect waves-light cyan lighten-1" href="actividadescomplementarias_editar_eliminar.php?clave_act=<?php echo $rs2['clave_act']; ?>">Editar</a>
							</td>
							
							<td class="center">
								<a class="btn waves-effect waves-light red" onclick="delete_actividad(<?php echo $rs2['clave_act']; ?>)" href="#">ELIMINAR</a>
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
  include('../extend/footer.php')
?>