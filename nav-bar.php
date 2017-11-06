

    <!-- Barra de navegación -->

    <div id="container">
    <header class="mainHeader sticky ">
      <div class="content">

        <!-- Elementos de navegación por el sitio -->

        <nav class="menu">
          <ul>
              <li><a href="index.php">Inicio</a></li>
              <li><a href="cursos.php">Cursos</a></li>
              <li><a href="ensena.php">Enseñá</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="tienda.php"><i class="material-icons">local_grocery_store</i></a></li>
          <?php if (isset($usuario)): ?>
              <li><a href="perfildeusuario.php"><?=$usuario['name'];?></a></li>
              <li><a href="perfildeusuario.php"><img src="<?=$laImagen[0];?>" alt="avatar" style="width: 30px;
                border-radius: 6px; padding-bottom: 0px; margin-top: 1px;"></a></li>
  			      <li><a href="logout.php">Salir</a></li>
          <?php else: ?>
              <li><a href="ingresar.php">Ingresar</a></li>
              <li><a href="registrarse.php">Registrarse</a></li>
          <?php endif; ?>

          </ul>
        </nav>

        <!-- Menú Hamburgesa -->

        <div class="menu-toggle patty">
          <div class="patty-inner"></div>
        </div>

        <!-- Logo en el NavBar -->

        <div class="logo">
            <a href="index.php"><img src="imagenes/tudi4.png" alt=""></a>
        </div>

      </div>
    </header>
    </div>
