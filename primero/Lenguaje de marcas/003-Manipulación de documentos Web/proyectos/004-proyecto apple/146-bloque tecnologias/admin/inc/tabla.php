<?php if(isset($_GET['tabla'])){?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <?php include "inc/cabeceras.php"?>
                </tr>
            </thead>
            <tbody>
                <?php include "inc/contenido.php"?>
            </tbody>
        </table>
    </div>
    <?php include "inc/paginador.php";?>
    <a href="?formulario=<?php echo $_GET['tabla'] ?>">
        <button id="nuevo">+</button>
    </a>
<?php } ?>
