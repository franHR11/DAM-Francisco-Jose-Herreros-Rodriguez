document.querySelector("button").onclick = function(){
    let usuario = document.querySelector("#usuario").value
    let contrasena = document.querySelector("#contrasena").value
    fetch("http://127.0.0.1:5000/login?usuario="+usuario+"&contrasena="+contrasena)
    .then(function(response){
        return response.json()
    })
    .then(function(datos){
        console.log(datos)
    })
}