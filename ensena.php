<?php

	require_once ('conexion.php');
	require_once ('funciones2.php');

	if (estaLogueado($db)) {
		$usuario = traerId($_SESSION['userId'], $db);
		$laImagen = glob('images/userAvatar/' . $usuario['email'] . '*');
	}


$title = 'Ensena';
require_once ('head.php');
require_once ('nav-bar.php');
 ?>

    <!-- Header (cabecera) de la página -->

     <sectxion class="hedro">
     <div class="home3-img">
       <div class="mainHeader-placeholder"></div>
       <div class="text-home">
         <h1 style="margin-bottom:40px;">Trascende tus conocimientos</h1>

         <h2 style="margin-bottom:40px;">¡Todo es posible!</h2>

         <h2 style="margin-bottom:40px;" class="pregunta">Si sabes algun oficio y queres compartir tus conocimientos este es tu lugar. En TUDIPA buscamos personas que estén dispuestas a enseñar y asistir a todo aquel interesado en aprender. </h2>

				 <h2 style="margin-bottom:40px;" class="pregunta">Los cursos pueden ser online o presenciales. Aquellos que son online se realizan a traves de videos, estos son grabados y subidos por los propios instructores.</h2>

				 <h2 style="margin-bottom:80px;" class="pregunta">Si lo que buscas es aprender no dudes en registrarte y formar parte de TUDIPA.</h2>

     </div>
      </div>


			<?php
			require_once ('footer.php');
			 ?>
