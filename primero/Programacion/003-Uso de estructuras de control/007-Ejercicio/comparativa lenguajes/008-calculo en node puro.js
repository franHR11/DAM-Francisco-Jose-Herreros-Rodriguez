var fechainicio = new Date()
var inicio = fechainicio.getTime()

var iteraciones = 1000000000
var numero = 1.00000000065

for(let i = 0;i<iteraciones;i++){
  numero *=1.000000045
}

var fechafinal = new Date()
var final = fechafinal.getTime()

console.log(final-inicio)