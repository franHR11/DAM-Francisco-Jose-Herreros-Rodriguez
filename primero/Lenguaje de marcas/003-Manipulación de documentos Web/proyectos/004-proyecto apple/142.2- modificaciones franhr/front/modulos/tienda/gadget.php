<head>
    <?php 
        include "inc/errores.php"; 
        include "inc/cabeza.php"; 
    ?>
</head>

<?php
if(isset($_GET['prod'])){
    echo '<div class="carrito-wrapper">
        <div class="carrito-container">
            <a href="tienda.php?prod='.$_GET['prod'].'" class="carrito-link">
                <button class="icono_boton" aria-label="Añadir al carrito">
                    <span class="iconify" data-icon="mdi:cart" data-width="24" data-height="24" style="color: white;"></span>
                </button>
                <span class="contador-carrito">0</span>
            </a>
            <div class="carrito-desplegable">
                <div class="productos-lista"></div>
                <div class="total-carrito"></div>
                <button class="ver-carrito">Ver carrito completo</button>
            </div>
        </div>
    </div>
    <script>
        function actualizarContadorCarrito() {
            const carrito = JSON.parse(localStorage.getItem("carrito") || "[]");
            const contador = document.querySelector(".contador-carrito");
            const productosLista = document.querySelector(".productos-lista");
            const totalCarrito = document.querySelector(".total-carrito");
            
            contador.textContent = carrito.length;
            contador.style.display = carrito.length > 0 ? "flex" : "none";
            
            productosLista.innerHTML = "";
            let total = 0;
            
            carrito.forEach((producto, index) => {
                const precio = parseFloat(producto.precio);
                total += precio;
                
                const productoElement = document.createElement("div");
                productoElement.className = "producto-mini";
                productoElement.innerHTML = `
                    <img src="${producto.imagen}" alt="${producto.nombre}">
                    <div class="producto-info">
                        <div>${producto.nombre}</div>
                        <div>${precio.toFixed(2)}€</div>
                    </div>
                    <button class="eliminar-producto" data-index="${index}">×</button>
                `;
                productosLista.appendChild(productoElement);
            });
            
            totalCarrito.innerHTML = `Total: ${total.toFixed(2)}€`;
            
            document.querySelectorAll(".eliminar-producto").forEach(btn => {
                btn.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const index = parseInt(this.dataset.index);
                    carrito.splice(index, 1);
                    localStorage.setItem("carrito", JSON.stringify(carrito));
                    actualizarContadorCarrito();
                };
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const carritoContainer = document.querySelector(".carrito-container");
            const carritoDesplegable = document.querySelector(".carrito-desplegable");
            
            let timeoutId;

            carritoContainer.addEventListener("mouseenter", function() {
                clearTimeout(timeoutId);
                carritoDesplegable.style.display = "block";
            });

            carritoContainer.addEventListener("mouseleave", function(e) {
                const toElement = e.relatedTarget;
                if (!carritoDesplegable.contains(toElement)) {
                    timeoutId = setTimeout(() => {
                        carritoDesplegable.style.display = "none";
                    }, 300); // Añadir un pequeño retraso para evitar parpadeos
                }
            });

            carritoDesplegable.addEventListener("mouseleave", function() {
                carritoDesplegable.style.display = "none";
            });

            // Asegurar que el carrito se actualice al cargar la página
            actualizarContadorCarrito();
        });

        window.addEventListener("storage", function(e) {
            if (e.key === "carrito") actualizarContadorCarrito();
        });
        setInterval(actualizarContadorCarrito, 1000);
    </script>';
}
?>
<style>
    <?php include "tienda.css"?>
</style>