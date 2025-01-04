console.log("ok en marcha")								// Mensaje de comprobación

let celdas = document.querySelectorAll("td")			// Selecciono todas las celdas

celdas.forEach(function(celda){							// Para cada una de las celdas
	celda.ondblclick = function(){						// Cuando le haga doble click a la celda
		console.log("ok has hecho doble click")		// Mensaje de comprobación
		
		// Restaurar tamaño original antes de hacer editable
        this.style.width = '';
        this.style.height = '';
		
		this.setAttribute("contenteditable","true")	// Ahora puedo editar la celda
		this.classList.add("celdaactiva")				// Añado una clase a la celda
		
		// Guardar dimensiones originales
        this.dataset.originalWidth = this.offsetWidth + 'px';
        this.dataset.originalHeight = this.offsetHeight + 'px';
		
		this.focus()											// Mete el foco dentro de la celda
	}
	celda.onblur = function(){								// Cuando salgo de la celda
		// Restaurar dimensiones originales si existen
        if(this.dataset.originalWidth) {
            this.style.width = this.dataset.originalWidth;
            this.style.height = this.dataset.originalHeight;
            delete this.dataset.originalWidth;
            delete this.dataset.originalHeight;
        }
		
		this.setAttribute("contenteditable","false")	// LA celda ya no es editable
		this.classList.remove("celdaactiva")			// Le quito la clase a la celda
		let contenido = this.textContent
		let tabla = this.getAttribute("tabla")
		let columna = this.getAttribute("columna")
		let identificador = this.getAttribute("identificador")
		fetch("actualizar.php?tabla="+encodeURI(tabla)+"&columna="+encodeURI(columna)+"&identificador="+encodeURI(identificador)+"&contenido="+encodeURI(contenido)+"")
	}
})