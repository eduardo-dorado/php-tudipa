<?php
session_start();
//Chequea si la cookie esta set y si esta la guarda en el $Session
if (isset($_COOKIE['userId'])) {
	$_SESSION['userId'] = $_COOKIE['userId'];
}
//Validea todo los ingresos de DATA en el formulario
	function validarUsuario($data, $files, $db){
		$errores = [];

		if (trim($data['name']) == '') {
			$errores['name'] = 'Escribí el nombre!';
		}

		if (trim($data['lastname']) == '') {
			$errores['lastname'] = 'Escribí el apellido!';
		}

		if (trim($data['email']) == '') {
			$errores['email'] = 'Escribí el email!';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errores['email'] = 'El email ES INVALIDO';
		} elseif (comprobarEmail($data['email'], $db) != false) {
			$errores['email'] = 'El email ya existe';
		}

		if (trim($data['username']) == '') {
			$errores['username'] = 'Escribí un nombre de usuario!';
		} elseif (comprobarUser($data['username'], $db) != false) {
			$errores['username'] = 'El username ya existe';
		}

		if (trim($data['password']) == '') {
			$errores['password'] = 'Escribí la contraseña!';
		} elseif (strlen($data['password']) < 6) {
			$errores['password'] = "La clave debe tener al menos 6 caracteres";
		} elseif (strlen($data['password']) > 16) {
			$errores['password'] = "La clave no puede tener más de 16 caracteres";
		} elseif (!preg_match('`[a-z]`',$data['password'])) {
			$errores['password'] = "La clave debe tener al menos una letra minúscula";
		} elseif (!preg_match('`[A-Z]`',$data['password'])) {
			$errores['password'] = "La clave debe tener al menos una letra mayúscula";
		} elseif (!preg_match('`[0-9]`',$data['password'])) {
			$errores['password'] = "La clave debe tener al menos un caracter numérico";
		}

		if (trim($data['repass']) == '') {
			$errores['repass'] = 'Escribí la contraseña de nuevo!';
		} elseif (trim($data['password']) != trim($data['repass'])) {
			$errores['repass'] = 'Las contraseñas no coinciden!';
		}

		if (trim($data['edad']) == '') {
			$errores['edad'] = 'Decinos tu edad!';
		}

		if ($files['avatar']['error'] != UPLOAD_ERR_OK) {
			$errores['imagen'] = 'Subí una imagen';
		}

		return $errores;
	}



	// == FUNCTION - traerTodos ==
	/*
		- NO recibe dos parámetros
		- Lee el JSON y arma un array de arrays de usuarios, cada línea en el JSON será un array de 1 usuario
		- Retorna el array con todos los usuarios
	*/
	function traerTodos($db){

			$query = $db->query('SELECT
						 usuarios.id,
						 usuarios.name,
						 usuarios.lastname,
						 usuarios.email,
						 usuarios.username,
						 usuarios.password
				FROM tudipa.usuarios');

				$usuariosFinal = [];

				$usuariosFinal = $query->fetchAll(PDO::FETCH_ASSOC);

				return $usuariosFinal;

		}


	// == FUNCTION - comprobarEmail ==
	/*
		- Recibe un parámetro
		- $_POST['email']
		- Usa la función traerTodos()
		- Retorna un array del usuario si encuentra el email. De no encontrarlo, retorna false
	*/
	function comprobarEmail($mail, $db){
		// Traigo todos los usuario
		$usuarios = traerTodos($db);

		// Recorro ese array
		foreach ($usuarios as $unUsuario) {
			// Si el mail del usuario en el array es igual al que me llegó por POST, devuelvo al usuario
			if ($unUsuario['email'] == $mail) {
				return $unUsuario;
			}
		}

		return false;
	}
	// == FUNCTION - comprobarUsername ==
	/*
		- Recibe un parámetro
		- $_POST['username']
		- Usa la función traerTodos()
		- Retorna un array del usuario si encuentra el Username. De no encontrarlo, retorna false
	*/
	function comprobarUser($username, $db){
		// Traigo todos los usuario
		$usuarios = traerTodos($db);

		// Recorro ese array
		foreach ($usuarios as $unUsuario) {
			// Si el mail del usuario en el array es igual al que me llegó por POST, devuelvo al usuario
			if ($unUsuario['username'] == $username) {
				return $unUsuario;
			}
		}

		return false;
	}


	function guardarUsuario($datos, $db){
		$Sql = "SELECT * FROM usuarios";
		$stmt = $db->query($Sql);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Sql2 = "INSERT INTO usuarios (name, lastname, email, username, password) VALUES ( ?,?,?,?,? )";
	        $stmt = $db->prepare($Sql2);
	        $stmt->execute( [
						$datos['name'],
						$datos['lastname'],
						$datos['email'],
						$datos['username'],
						password_hash($datos['password'], PASSWORD_DEFAULT)
	            ] );
	    }


	// == FUNCTION - guardarImagen ==
	/*
		- Recibe dos parámetros
		- $laImagen: el nombre del input de la imagen - $errores: el array de errores
		- Se encarga de guardar el archivo de imagen en la ruta definida
		- Retorna un array de errores si los hay
	*/
	function guardarImagen($laImagen, $errores){
		if ($_FILES[$laImagen]['error'] == UPLOAD_ERR_OK) {
			// Capturo el nombre de la imagen, para obtener la extensión
			$nombreImagen = $_FILES[$laImagen]['name'];
			// Obtengo la extensión de la imagen
			$ext = pathinfo($nombreImagen, PATHINFO_EXTENSION);
			// Capturo el archivo temporal
			$archivoImagen = $_FILES[$laImagen]['tmp_name'];
			// Pregunto si la extensión es la deseada
			if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
				// Armo la ruta donde queda gurdada la imagen
				$rutaArchivo = dirname(__FILE__) . '/images/userAvatar/' . $_POST['email'] . '.' . $ext;
				// Subo la imagen definitivamente
				move_uploaded_file($archivoImagen, $rutaArchivo);
			} else {
				$errores['imagen'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
			}
		} else {
			// Genero error si no se puede subir
			$errores['imagen'] = 'No se pudo subir la imagen';
		}

		return $errores;
	}


	// == FUNCTION - traerId ==
	/*
		- Recibe un parámetro
		- $id:
	*/
	function traerId($id, $db){
		// me traigo todos los usuarios
		$usuarios = traerTodos($db);

		// Recorro el array de todos los usuarios
		foreach ($usuarios as $unUsuario) {
			if ($id == $unUsuario['id']) {
				return $unUsuario;
			}
		}

		return false;
	}


	// == FUNCTION - validarLogin ==
	/*
		- Recibe un parámetros
		- $_POST
		- Usa la función comprobarEmail()
		- Retorna un array de errores que puede estar vacio
	*/
	function validarLogin($data, $db){
		$errores = [];

		if (trim($data['email']) == '') {
			$errores['email'] = 'Los datos no son correctos';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errores['email'] = 'Los datos no son correctos';
		} else if (comprobarEmail($data['email'], $db) == false) { // Busco el email que se está queriendo loguear, si no existe, tiro error
      	$errores["email"] = "Los datos no son correctos";
     	} else {
      	// si el mail existe, me guardo al usuario dueño del mismo
      	$usuario = comprobarEmail($data['email'], $db);
 			// pregunto si coindice la password escrita con la guardada en el JSON
      	if (password_verify($data["password"], $usuario["password"]) == false) {
         	$errores["email"] = "Los datos no son correctos";
      	}
			//pregunto si vino algun valor en el check de recordar y seteo el cookie
		}if (isset($data['recordarme'])) {
			if ($data['recordarme'] == 'on') {
     		setcookie("userId",$usuario['id'],time() + (86400  * 10));
			} else {
				false;
			}
		}


		return $errores;
	}


	// FUNCTION - loguear
	function loguear($usuario) {
		// Guardo en $_SESSION el ID del USUARIO
	   $_SESSION['userId'] = $usuario['id'];
	}

// FUNCTION - Devuelve tipo de Session activa
function estaLog(){
	 $user = [];
	if (isset($_SESSION['userId'])) {
		return $_SESSION['userId'];
	} elseif (isset($_COOKIE['userId'])) {
		return $_COOKIE['userId'];
	}
}
	// FUNCTION - estaLogueado
	function estaLogueado($db) {
		return isset($_SESSION['userId']);
	}
//FUNCTION - CLEAR Cookies y Session
	function clearsessionscookies(){
		unset($_SESSION['userId']);
		session_unset();
		session_destroy();
		setcookie("userId",$usuario['id'],time() + (-86400  * 10));
		setcookie("bienvenidname",$usuarioAGuardar['name'],time() + (-86400  * 10));
		setcookie("bienvenidolastname",$usuarioAGuardar['lastname'],time() + (-86400  * 10));
		setcookie("userDb",$_POST['user'],time() + (-86400  * 10));
		setcookie("passDb",$_POST['password'],time() + (-86400  * 10));
	}

function validarModificacion($data){
	$errores = [];

	if (trim($data['name']) == '') {
		$errores['nombre'] = 'Che escribí el nombre!';
	}

	if (trim($data['lastname']) == '') {
		$errores['lastname'] = 'Che escribí el apellido!';
	}

	if (trim($data['edad']) == '') {
		$errores['edad'] = 'Decinos tu edad!';
	}


	return $errores;
}

	function migrarUsuarioDB($datos, $db){
		$Sql = "SELECT * FROM usuarios";
		$stmt = $db->query($Sql);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Sql2 = "INSERT INTO usuarios (name, lastname, email, username, password) VALUES ( ?,?,?,?,? )";
					$stmt = $db->prepare($Sql2);
					$stmt->execute( [
						$datos['name'],
						$datos['lastname'],
						$datos['email'],
						$datos['username'],
						password_hash($datos['password'], PASSWORD_DEFAULT)
							] );
			}

			function traerJson(){
				// Obtengo el contenido del JSON
				$archivo = file_get_contents("tudipa.json");

				// esto me arma un array con todos los usuarios
					$usuariosJSON = explode(PHP_EOL, $archivo);

				// Saco el último elemento que es una línea vacia
				array_pop($usuariosJSON);

				// Creo un array vacio, para guardar los usuarios
				$usuariosFinal = [];

				// Recorremos el array y generamos por cada usuario un array del usuario
				foreach ($usuariosJSON as $usuario) {
					$usuariosFinal[] = json_decode($usuario, true);
				}

				return $usuariosFinal;
			}


	function migrar($db){
		$usuarios = traerJson();
		foreach ($usuarios as $key => $value) {
						migrarUsuarioDB($value, $db);

		}
	}


	//function updateDB($datos, $db, $usuario){
	//	$Sql = "SELECT * FROM usuarios";
	//	$stmt = $db->query($Sql);
	//	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//	$Sql2 = "UPDATE INTO usuarios (name, lastname)
	//						VALUES ( ?,? )
	//						WHERE (id = $usuario['id'])";
	//				$stmt = $db->prepare($Sql2);
	//				$stmt->execute( [
	//					$datos['name'],
	//					$datos['apellido'],
	//						] );
	//		}

	function createDb($data){
			$dsn = 'mysql:host=localhost;dbname=mysql;';
			$db_user = $_POST['user'];
			$db_pass = $_POST['password'];
			$opciones = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );


			try {
				$db = new PDO($dsn, $db_user, $db_pass, $opciones);
			}catch( PDOException $e ){
				echo $e->getMessage();
			}

			$db->beginTransaction();

			try{

		  	$db->query('CREATE SCHEMA tudipa;');

		  	$db->query('USE tudipa;');

		  	$db->query('CREATE TABLE usuarios(
			  	id int unsigned auto_increment primary key ,
		    	name varchar(50) not null,
		    	lastname varchar(50) not null,
		    	email varchar(100) not null unique,
		    	username varchar(50) not null unique,
		    	password varchar(100) not null
		  		);');

		  	$db->commit();

		  	$dataBase = 'La Base de Datos se creó exitosamente';

			}	catch( PDOException $e ){
		  $db->rollBack();
		  echo 'El error fue->'.$e->getMessage();
			}
		}
