let puntos = document.querySelectorAll(".punto")
puntos.forEach(function(punto,index){
	punto.onclick = function(){
		console.log("Has hecho click en un punto")
		console.log(index)
	}
})