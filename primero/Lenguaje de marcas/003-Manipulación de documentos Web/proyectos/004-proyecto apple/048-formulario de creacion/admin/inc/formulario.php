<?php if(isset($_GET['formulario'])){?>
    <h3>Nuevo elemento: <?php echo $_GET['formulario'] ?></h3>
    <form action="insertar.php">
        <input type="hidden" name="tabla" value="<?php echo $_GET['formulario'] ?>">
        <?php include "inc/camposformulario.php"?>
        <input type="submit">
    </form>
    </form>
<?php } ?>