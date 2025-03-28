<?php
// CONEXION BASE DE DATOS
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

// AUTENTICAR USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = 'el email es obligatorio';
    }

    if (!$password) {
        $errores[] = 'La contraseña es obligatoria';
    }

    if (empty($errores)) {
        // revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);

        

        if ($resultado->num_rows) {
            //revisar si la contraseña es correcta
            $usuario = mysqli_fetch_assoc($resultado);
            // verificar si el password es correcto o normalizer_get_raw_decomposition
            $auth = password_verify($password, $usuario["password"]);

            if($auth) {
                    session_start();
                    //llenar el arreglo de la session
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION['login'] = true;

                    header('location: /admin');
            }else{
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = 'El usuario no existe';
        }

    }
}



// HEADER

require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>





    <form method="POST" class="formulario">

        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Email" id="email" require />

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="password" id="password" require />

        </fieldset>

        <input type="submit" class="boton boton-verde" value="Iniciar Sesión">


    </form>

</main>

<?php
incluirTemplate('footer');
?>