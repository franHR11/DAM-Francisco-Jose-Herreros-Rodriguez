<?php
require '../includes/app.php';

estaAutenticado();
use App\Propiedad;
// implementar metodo para obtener propiedades

$propiedades = Propiedad::all();    


// MUESTRA MENSAJE CONDICIONAL
$resultado = $_GET["resultado"] ?? null;

// eliminar Imagen

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id){

// ELIMINAR EL ARCHIVO

$query = "SELECT imagen FROM propiedades WHERE id = {$id}";

$resultado = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultado);

unlink("../imagenes/" . $propiedad["imagen"]);


// ELIMINAR LA PROPIEDAD

        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header("Location: ./index.php?resultado=3");
        }   
    }

}




//TEMPLATES

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador Inmobiliaria</h1>
    
    <?php if ($resultado == 1):  ?>
        <p class="alerta correcto">Anuncio creado Correctamente</p>
        <?php elseif ($resultado == 2):  ?>
            <p class="alerta correcto">Anuncio Actualizado Correctamente</p>
        <?php elseif ($resultado == 3):  ?>
            <p class="alerta correcto">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            foreach($propiedades as $propiedad):
                ?>

                <tr>
                    <td>
                        <?php
                        echo $propiedad->id;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $propiedad->titulo;
                        ?>
                    </td>
                    <td>
                        <img src="../imagenes/<?php echo $propiedad->imagen;?>" class="imagen-tabla">
                    </td>
                    <td>
                        <?php
                        echo $propiedad->precio;
                        ?>
                        €
                    </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                
                            
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                       
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id;?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>

    </table>



</main>

<?php
// CERRAR LA CONEXION
mysqli_close($db);


incluirTemplate('footer');
?>