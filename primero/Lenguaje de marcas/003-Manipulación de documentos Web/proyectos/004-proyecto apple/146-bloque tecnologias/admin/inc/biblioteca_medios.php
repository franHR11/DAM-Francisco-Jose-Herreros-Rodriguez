<?php
function obtenerImagenesBiblioteca() {
    // Corregir la ruta al directorio static
    $directorio = dirname(dirname(dirname(__FILE__))) . '/static/';
    $imagenes = [];
    
    if (is_dir($directorio)) {
        $archivos = scandir($directorio);
        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imagenes[] = $archivo;
                }
            }
        }
    }
    
    return $imagenes;
}

if(isset($_GET['modal'])) {
    $imagenes = obtenerImagenesBiblioteca();
    ?>
    <div class="biblioteca-medios">
        <div class="biblioteca-grid">
            <?php foreach($imagenes as $imagen): ?>
            <div class="imagen-item" onclick="seleccionarImagen('<?php echo htmlspecialchars($imagen); ?>')" data-imagen="<?php echo htmlspecialchars($imagen); ?>">
                <div class="imagen-contenedor">
                    <img src="../static/<?php echo htmlspecialchars($imagen); ?>" 
                         alt="<?php echo htmlspecialchars($imagen); ?>"
                         loading="lazy">
                </div>
                <div class="imagen-nombre"><?php echo htmlspecialchars($imagen); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
    .biblioteca-medios {
        padding: 20px;
    }
    .biblioteca-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        max-height: 70vh;
        overflow-y: auto;
        padding: 10px;
    }
    .imagen-item {
        border: 2px solid #ddd;
        padding: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        border-radius: 4px;
    }
    .imagen-item:hover {
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .imagen-contenedor {
        position: relative;
        width: 100%;
        padding-bottom: 100%; /* Aspecto cuadrado */
        margin-bottom: 5px;
    }
    .imagen-contenedor img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Mantiene la proporción y cubre el contenedor */
        border-radius: 2px;
    }
    .imagen-nombre {
        font-size: 12px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 5px;
        text-align: center;
        color: #333;
    }
    .imagen-item.selected {
        border-color: #28a745;
        box-shadow: 0 0 0 2px #28a745;
    }
    /* Estilos para el scrollbar */
    .biblioteca-grid::-webkit-scrollbar {
        width: 8px;
    }
    .biblioteca-grid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    .biblioteca-grid::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    .biblioteca-grid::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .imagen-item.selected {
        border: 3px solid #28a745 !important;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.5) !important;
        transform: scale(1.05);
    }
    </style>

    <script>
    function seleccionarImagen(imagen) {
        // Remover selección previa
        document.querySelectorAll('.imagen-item').forEach(item => {
            item.classList.remove('selected');
        });
        
        // Añadir selección al elemento actual
        const item = document.querySelector(`[data-imagen="${imagen}"]`);
        if (item) {
            item.classList.add('selected');
        }
        
        // Comunicar la selección a la ventana principal
        window.parent.imagenSeleccionada = imagen;
        // Asegurarnos de que la ventana principal reciba la selección
        if (window.parent && typeof window.parent.actualizarSeleccionImagen === 'function') {
            window.parent.actualizarSeleccionImagen(imagen);
        }
    }
    </script>
    <?php
}
?>
