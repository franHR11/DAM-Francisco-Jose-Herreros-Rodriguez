<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Escritorio</title>
        <link rel="stylesheet" href="estilo/escritorio.css">
    </head>
    <body>
        <header>
          
        </header>
        <main>
            <nav>
                <ul>
                <?php
                    $produtos = ["Inicio", "Productos", "Noticias", "Contacto"];
                    foreach ($produtos as $clave=>$valor) {
                        echo "<li>".$valor."</li>";
                    }
                ?>
                </ul>
            </nav>
                <section>
                    <table>
                        <thead>
                            </tr>
                                <?php
                                    $columnas = ['identificador','nombre','descripcion','precio','peso'];
                                    foreach ($columnas as $clave=>$valor) {
                                        echo "<td>".$valor."</td>";
                                     }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($i= 0; $i< 30; $i++) {
                                    echo '<tr>';
                                        foreach ($columnas as $clave=>$valor) {
                                            echo "<td>".$valor."</td>";        
                                        }
                                    echo '</tr>';
                                }
                            ?>
                        
                        </tbody>
                    </table>    
                </section>
        </main>
        <footer>
            <p>Proyecto Apple</p>
        </footer>
    </body>
</html>