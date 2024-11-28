function amarillo1(){
	document.querySelector("#op1").style.background = "yellow"
}
function blanco1(){
	document.querySelector("#op1").style.background = "white"
}
function amarillo2(){
	document.querySelector("#op2").style.background = "yellow"
}
function blanco2(){
	document.querySelector("#op2").style.background = "white"
}

function calcula(){
	// Quiero que se coja el contenido del input 1
	var valor1 = document.querySelector("#op1").value*1
	// Quiero que se coja el contenido del input 2
	var valor2 = document.querySelector("#op2").value*1
	// Quiero que se sumen los dos valores
	var suma = valor1 + valor2
	// Y por ultimo quiero que el resultado se ponga en la etiqueta p
	document.querySelector("p").textContent = suma
}