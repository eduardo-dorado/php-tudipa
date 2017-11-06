<?php


	require_once ('conexion.php');
	require_once ('funciones2.php');

	if (estaLogueado($db)) {
		$usuario = traerId($_SESSION['userId'], $db);
		$laImagen = glob('images/userAvatar/' . $usuario['email'] . '*');
	}


	if(!estaLog()){
		header('Location: registrarse.php'); exit;
	}

	$elUsuario = traerId(estaLog(), $db);

	$laImagen = glob('images/userAvatar/' . $elUsuario['email'] . '*');


	require_once('head.php');
	require_once('nav-bar.php');
?>
<<div class="login-page" id="form-with">
	<div class="form3">
		<form class="login-form" >

	<span style="grid-column: 2/1;"><img src="<?=$laImagen[0];?>" alt="avatar" style="height: 49px;
		width: 52px; background-repeat: no-repeat; background-position: 50%; border-radius: 28%; background-size: 100% auto;"></span>

	<input style="grid-column: 2/4;" type="text" name="username" value="<?=$elUsuario['username'];?>" disabled>

	<input style="grid-column: 1/3" type="text" name="name" value="<?=$elUsuario['name'];?>" disabled>

	<input style="grid-column: 1/0;" type="text" name="apellido" value="<?=$elUsuario['lastname'];?>" disabled>

	<input style="grid-column: 1/4;" type="text" name="email" value="<?=$elUsuario['email'];?>" disabled>

	<a href="index.php"><input id="button2" name="login" type="button" href="index.php" value="Home"></a>

	<a href="modificar.php"><input id="button2" name="login" type="button" href="modificar.php" value="Modificar"></a>

	<a href="logout.php"><input id="button2" name="login" type="button" href="logout.php" value="Salir"></a>

		</form>
	</div>
</div>
<?php
require_once ('footer.php');
 ?>
