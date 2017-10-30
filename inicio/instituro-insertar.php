
<?php 
	require_once('../conexion/conexion.php');

	$sql = 'SELECT * FROM instituto';

	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

	if($_POST){
   		

   		$insertar = 'INSERT INTO instituto(clave_instituto,nombre_instituto) VALUES(?,?)';

		$ac = isset($_POST['clave_instituto']) ? $_POST['clave_instituto']: '';
		$nombre_depart = isset($_POST['nombre_instituto']) ? $_POST['nombre_instituto']: '';

		$statement_insert = $pdo->prepare($insertar);
	  	$statement_insert->execute(array($ac,$nombre_depart));
	  	header('Location: instituro-insertar.php');
   	} 
	

?>
<?php
//Header--------------------------------> 
 	include('../extend/header.php');
?>


<div class="container">
	<div class="col s12">
		<h3 class="card-title">Agregar nuevo instituto</h3>

	    	<form  method="post" class="col s5" >
		      	<div class="row">
					<div class="input-field col s5">
	          			<input placeholder="Clave del instituto" name="clave_instituto" type="text">
	       			</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
	          		<input placeholder="Nombre del instituto" name="nombre_instituto" type="text">
	       			</div>
				</div>
				
				<input class="btn waves-effect waves-light cyan" type="submit" value="Agregar" />
			</form>
	</div>
</div>

<!--tabla-->
<div class="container">
	<div class="col s12">
		<div class="row">
			
			
			<h2 class="card-title">Departamento</h2>
			<table class="striped">
			<thead>
			    <tr>
			    	<th class="center">Clave</th>
			       	<th class="center">Nombre</th>
			       	
			    </tr>
			</thead>

				<tbody>
					<?php 
						foreach($results as $rs) {
					?>
					<tr>
						<td class="center"><?php echo $rs['clave_instituto']?></td>
						<td class="center"><?php echo $rs['nombre_instituto']?></td>
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