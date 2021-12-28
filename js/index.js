var cargaPagina = document.addEventListener("DOMContentLoaded",() =>{
    var detalleProducto = document.getElementsByClassName("cargaDetallesProducto");

    for(i=0; i<detalleProducto.length; i++)
        detalleProducto[i].addEventListener("click", agregaDireccionamiento);
    
    function agregaDireccionamiento()
    {
        window.location.href = "detalles-producto.html";
    }
});