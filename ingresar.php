<?php


	require_once ('conexion.php');
	require_once ('funciones2.php');

if(estaLog()){
		header('Location: perfildeusuario.php'); exit;
	}

	if ($_POST) {

		// Validación - La función validarUsuario retorna un array
		$erroresFinales = validarLogin($_POST, $db);

		if (empty($erroresFinales)) {
			// Guardo en la variable $usuario los datos del usuario que se quiere loguear
	      $usuario = comprobarEmail($_POST["email"], $db);

		 	// Guardo al ID del usuario en $_SESSION.
	      loguear($usuario);

			// Ok redirecciono
			header('location: index.php'); exit;
		}
	}
$title = 'Ingresar';
require_once('head.php');
require_once('nav-bar.php');

 ?>

    <!-- Header (cabecera) de la página -->

    <div class="login-page">
     <div class="form2">

			 <h2>Login</h2>

       <form class="login-form" method="post" >

          <input type="text" name="email" placeholder="Correo"/>

          <input type="password" name="password" placeholder="Contraseña"/>
            <?php if (isset($erroresFinales['email'])): ?>
				      <span style="color: rgb(166, 11, 48);"><?=$erroresFinales['email'];?></span>
			      <?php endif; ?>
					<br>
 					<br>
         <label>
          <input id="check" name="recordarme" type="checkbox" value="on">
          <a style="text-decoration: none; color: #3e433e;";>Recuérdame</a>
         <label>
					 <br>
         <label>
          <input id="check" name="olv-contrasena" type="checkbox" value="on">
          <a  style="text-decoration: none; color: #3e433e;";>Olvidé mi contraseña</a>
         <label>

        <button id="button1" type="submit" class="button">Ingresar</button>

         <p class="mensaje"><a href="registrarse.php">No tengo usuario. ¡Quiero uno ya!</a></p>

       </form>
     </div>
   </div>

	 <?php
	 require_once ('footer.php');
	  ?>
