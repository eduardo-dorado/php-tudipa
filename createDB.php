<?php
	require_once ('funciones2.php');


	if ($_POST){
		if ($_POST['createDB']) {
		createDb($_POST);
		setcookie("userDb",$_POST['user'],time() + (86400  * 10));
		setcookie("passDb",$_POST['password'],time() + (86400  * 10));
		$dataBase = 'La base se creo correctamente';
	} elseif ($_POST['migrate']) {
		require_once ('conexion.php');
		migrar($db);
		header('Location: index.php');
		}
	}


$title = 'createDbTudipa';
require_once ('head.php');
require_once ('nav-bar.php');

?>
<script>
function show()
{
document.getElementById('BDatos').style.display="block";
}
</script>

     <div class="login-page" >
			 <div class="form2">
				 <h2>Manejo de Bases de Datos</h2>
				<?php if (isset($dataBase)): ?>
					<h2><?php echo $dataBase?></h2>
				<?php endif; ?>
				 <form class="" action="" method="post">

						 <input type="text" name="user" value="Usuario de MySQL">

						 <input type="text" name="password" value="Password de MySQl">

						 <input type="submit" id="button2" class="button" name="createDB" value="CrearDB y Tabla">

						 <input type="submit" class="button" id="button2" name="migrate" value="Migrar">


				 </form>
			 </div>


      </div>



 	 <?php
 	 require_once ('footer.php');
 	  ?>
