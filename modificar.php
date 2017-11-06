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

	$elUsuario = traerId($_SESSION['userId']);
	$laImagen = glob('images/userAvatar/' . $elUsuario['email'] . '*');


	if ($_POST) {

		$erroresFinales = validarModificacion($_POST);

		if (empty($erroresFinales)) {

  	updateDB($_POST,$db, $_SESSION['userId']);




	header('location: perfildeusuario.php'); exit;

	}
}

	require_once('head.php');
	require_once('nav-bar.php');
?>

<div class="login-page" id="form-with">
 <div class="form3">
	 <form class="login-form"method="POST"  >

		 <div class="company-info" style="grid-column: 1/3; margin-bottom: 30px;">
			 <h2>Registro</h2>
			 <ul>
				 <li><?php if (isset($erroresFinales['nombre'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['nombre'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['apellido'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['apellido'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['username'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['username'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['edad'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['edad'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['email'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['email'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['pass'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['pass'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['repass'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['repass'];?></span>
				 <?php endif; ?></li>
				 <li><?php if (isset($erroresFinales['imagen'])): ?>
				 <span style="color: rgb(166, 11, 48);;"><?=$erroresFinales['imagen'];?></span>
				 <?php endif; ?></li>
			 </ul>
		 </div>



		 <span><img src="<?=$laImagen[0];?>" alt="avatar" width="80" style="height: 49px;
			 width: 52px; background-repeat: no-repeat; background-position: 50%; border-radius: 28%; background-size: 100% auto;"></span>

		 <input type="text" name="name" value="<?=$elUsuario['name'];?>"disabled>




		 <input type="text" name="apellido" value="<?=$elUsuario['lastname'];?>"disabled>


		 <input type="text" name="username" value="<?=$elUsuario['username'];?>" disabled>


		 <input type="text" name="edad" placeholder="Edad" value="<?=$elUsuario['edad'];?>"disabled>


		 <input type="text" name="email" value="<?=$elUsuario['email'];?>" disabled>

		 <button id="button2" type="submit" style="height: 46px;">Aplicar</button>

		 <a href="index.php"><input id="button2" name="login" type="button" href="index.php" value="Home"></a>

	 </form>
 </div>
</div>


 <?php
 require_once('footer.php');
?>
