<?php

	require_once ('conexion.php');
	require_once ('funciones2.php');

	if (estaLogueado($db)) {
		$usuario = traerId($_SESSION['userId'], $db);
		$laImagen = glob('images/userAvatar/' . $usuario['email'] . '*');
	}


$title = 'Cursos';
require_once('head.php');
require_once('nav-bar.php');
 ?>

    <!-- Header (cabecera) de la página -->


     <section>
     <div class="content">
     <div class="busqueda flex-container">
         <h2>¡Elegí tu proximo oficio!</h2>
         <h3>Profesionales dispuestos a ayudarte en todo momento mientas avanzas con tu curso</h3>
         <!-- <div class="flex-container"> -->

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/oficio_1.jpg" alt="">
                 </div>
                 <h4>Seguridad para trabajar</h4>

                 <span>$200</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/oficio_2.jpg" alt="">
                 </div>
                 <h4>Carpintería</h4>

                 <span>$100</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/maquillaje.jpg" alt="">
                 </div>
                 <h4>Maquillaje Express</h4>

                 <span>$300</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/asado.jpg" alt="">
                 </div>
                 <h4>Asado profesional</h4>

                 <span>$80</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/cocina-china.jpg" alt="">
                 </div>
                 <h4>Cocina China</h4>

                 <span>$150</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/contable.jpg" alt="">
                 </div>
                 <h4>Contabilidad Básica</h4>

                 <span>$300</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/durlock.jpg" alt="">
                 </div>
                 <h4>Durlock inicial</h4>

                 <span>$400</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/manicure.jpg" alt="">
                 </div>
                 <h4>Manicure</h4>

                 <span>$100</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/rejas.jpg" alt="">
                 </div>
                 <h4>Rejas para ventanas</h4>

                 <span>$180</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/web.jpg" alt="">
                 </div>
                 <h4>Desarrollo web</h4>

                 <span>$500</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/zapatero.jpg" alt="">
                 </div>
                 <h4>Zapateria integral</h4>

                 <span>$320</span>

                 <button type="button" name="button">Comprar</button>
               </div>

               <div class="flex-item">
                 <div class="marca">
                   <img src="imagenes/parrilla.jpg" alt="">
                 </div>
                 <h4>Parrila de acero</h4>

                 <span>$120</span>

                 <button type="button" name="button">Comprar</button>
               </div>

      </div>
   </div>
 </section>



 </div>

 <?php
 require_once ('footer.php');
  ?>
