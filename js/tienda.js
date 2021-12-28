var cargaPagina = document.addEventListener("DOMContentLoaded",()=>{
    var categorias = document.getElementsByClassName("categorias");
    var checar = document.getElementsByClassName("checkboxesMarcados");

    for(i=0; i<categorias.length; i++)
        categorias[i].addEventListener("click",agregaEventoClic);
    for(k=0; k<checar.length; k++)
        checar[k].addEventListener("click",agregaChecked);

    function agregaEventoClic()
    {
        //EL ULTIMO ELEMENTO DE ARREGLO CATEGORIAS TIENE EL ELEMENTO FILTRAR POR PRECIO
        for(j=0; j<categorias.length; j++)
            categorias[j].removeAttribute("id");
        this.setAttribute("id","seleccionado");
        console.log("SELECCIONADO");
    }
    function agregaChecked()
    {
        if(this.childNodes[1].getAttribute("checked") == "" || this.childNodes[1].getAttribute("checked") == null)
            this.childNodes[1].setAttribute("checked","true");
        else
            this.childNodes[1].removeAttribute("checked");
    }
});