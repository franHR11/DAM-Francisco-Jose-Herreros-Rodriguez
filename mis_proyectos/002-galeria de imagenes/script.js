const fulImgBox = document.getElementById("fulImgBox"),
fulImg = document.getElementById("fulImg");

function abririmagencompleta(reference){
    fulImgBox.style.display = "flex";
    fulImg.src = reference
}
function cerrarImg(){
    fulImgBox.style.display = "none";
}