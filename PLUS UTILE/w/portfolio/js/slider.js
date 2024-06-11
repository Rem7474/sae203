var numero = 0;
function ChangeSlide(sens) {
    for (let pas = 0; pas < 2; pas++){
        if (pas==0){
            var ext="webp";
        }
        else{
            var ext="jpg";
        }
        for (let step = 400; step <=1000 ; step=step+300){
            taille = step;
            slide = new Array(`http://srv-peda.iut-acy.local/cuvelire/img/montagne1_${taille}.${ext}`, `http://srv-peda.iut-acy.local/cuvelire/img/nature_${taille}.${ext}`, `http://srv-peda.iut-acy.local/cuvelire/img/gare_${taille}.${ext}`, `http://srv-peda.iut-acy.local/cuvelire/img/eglise_${taille}.${ext}`);
            if (`slide_${taille}_${ext}` == "slide_1000_jpg"){
                document.getElementById(`slide_${taille}_${ext}`).src = slide[numero];
            }
            else{
                document.getElementById(`slide_${taille}_${ext}`).srcset = slide[numero];
            }
        }
    }
    numero = numero + sens;
    if (numero < 0)
        numero = slide.length - 1;
    if (numero > slide.length - 1)
        numero = 0;

}