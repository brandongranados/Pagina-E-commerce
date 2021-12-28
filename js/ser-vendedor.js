var cargaPagina = document.addEventListener("DOMContentLoaded", ()=>{
    var calculaHeigt = document.getElementsByClassName("calcular");
    var inputFile = document.getElementById("file-subir");
    var inputFileLabel = document.getElementById("file-subir-label");
    var mostrarImg = document.getElementById("imagenSubir");

    calcularAltuta();
    inputFile.addEventListener("change", previsualizar);

    function calcularAltuta()
    {
        var tamAlturaMain = 0;
        calculaHeigt[5].style.margin = "10px 16.66% 10px 8.33%";
        tamAlturaMain += calculaHeigt[5].clientHeight;
        calculaHeigt[6].style.margin = "10px 8.33% 10px 16.66%";
        tamAlturaMain += calculaHeigt[6].clientHeight;
        calculaHeigt[0].style.height = ((tamAlturaMain/2)-20)+"px";
        for(i=1; i<5; i++)
            calculaHeigt[i].style.height = ((tamAlturaMain/8)-20)+"px";
        for(j=0; j<5; j++)
            calculaHeigt[j].style.margin = "10px 8.33% 10px 16.66%";
        calculaHeigt[4].style.margin = "10px 22% 10px 28%";
        inputFileLabel.style.display = "block";
    }
    function previsualizar()
    {
        var img = inputFile.files[0];
        var leer = new FileReader;
        if(img)
        {
            leer.readAsDataURL(img);
            leer.onloadend = function()
            {
                mostrarImg.setAttribute("src",leer.result);
                mostrarImg.style.display = "block";
                inputFileLabel.style.display = "none";
            }
        }
        else
        {
            mostrarImg.removeAttribute("src");
            mostrarImg.style.display = "none";
            inputFileLabel.style.display = "block";
        }
    }
});