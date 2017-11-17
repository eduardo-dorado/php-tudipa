<?php

	require_once ('conexion.php');
	require_once ('funciones2.php');


if(estaLog()){
		header('Location: perfildeusuario.php'); exit;
	}

  $nombre = '';
	$apellido = '';
	$email = '';
	$username = '';
  $edad = '';

  if ($_POST) {

		// Persistencia
		$nombre = $_POST['name'];
		$apellido = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
    $edad = $_POST['edad'];

		// Validación - La función validarUsuario retorna un array
		$erroresFinales = validarUsuario($_POST, $_FILES, $db);

		if (empty($erroresFinales)) {

			// Si no hay errores en POST 1ero ejecuto la función de guardar la imagen
			$erroresFinales = guardarImagen('avatar', $erroresFinales);

			// Vuelvo a preguntar si el array de errores está vació
			if (empty($erroresFinales)) {
				// Creo Usuario en ARRAY, $usuarioAGuardar recibe el return de la función crear usuario, que es un array asociativo que armé como yo quería.

				//$usuarioAGuardar = crearUsuario($_POST);
				guardarUsuario($_POST, $db);
				// Guardo Usuario en JSON, recibe el array guardado en la variable de arriba
				//guardarUsuario($usuarioAGuardar);
				//cuando se registra setea la cookie para que traiga el nombre del que se registro
				setcookie("bienvenidname",$_POST['name'],time() + (86400  * 10));
				setcookie("bienvenidolastname",$_POST['lastname'],time() + (86400  * 10));


				// Ok guardado, redireccionado
				header('location: gracias.php'); exit;
			}
		}
	}
	$title = 'Registrarse';
	require_once ('head.php');
	require_once ('nav-bar.php');
 ?>


    <!-- Header (cabecera) de la página -->

    <<div class="login-page" id="form-with">
     	<div class="form3">

				<div class="company-info">
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

       		<form class="login-form" method="post" enctype="multipart/form-data">

         	<input type="text" name="name" placeholder="Nombre" value="<?=$nombre;?>">


         	<input type="text" name="lastname" placeholder="Apellido" value="<?=$apellido;?>">


         	<input type="text" name="username" placeholder="Usuario" value="<?=$username;?>">


         	<input type="text" name="edad" placeholder="Edad" value="<?=$edad;?>">


         	<input type="text" name="email" placeholder="Correo" 		value="<?=$email;?>">


         	<input type="password" name="password" placeholder="Contraseña">


         	<input type="password" name="repass" placeholder="Repetir Contraseña">

					<input type="button" value="Carga tu Avatar" onclick="document.getElementById('botonFileReal').click();" id= "button2">
					<input type="file" name="avatar" value="" style="display:none" id="botonFileReal" multiple>



       	<label style="grid-column: 1/3;">
          <input id="check"name="remember" type="checkbox" value="Recordarme">
           <a href="condiciones.php" style="text-decoration: none; color: #3e433e;";>Acepto los Términos y Condiciones</a>
      	<label>

        <button id="button2" type="submit" class="button">Registrarse</button>

        <p class="mensaje">¿Ya estas registrado? <a href="ingresar.php">Logueate</a></p>

         <!-- <p class="mensaje"><a href="registrarse.html">No tengo usuario. ¡Quiero uno ya!</a></p> -->
      </form>

     </div>
   </div>

	 <?php
	 require_once ('footer.php');
	  ?>
