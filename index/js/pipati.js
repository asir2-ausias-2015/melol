function pipati(){
    var usuarioElige = prompt("piedra, papel o tijera?");
    var computadoraElige = Math.random();
    if (computadoraElige <0.34) {
    	computadoraElige = "piedra";
    }
    else if(computadoraElige <=0.67) {
    	computadoraElige = "papel";
    }
    else{
    	computadoraElige = "tijera";
    };

    var comparar = function(eleccion1, eleccion2) {
        if (eleccion1 === eleccion2) {alert ("¡Es un empate!"); return}
        if (eleccion1 === "piedra") {
            if (eleccion2 === "tijera") {alert ("Piedra gana"); return}
            else {alert ("Papel gana"); return}
            }
        else if (eleccion1 === "papel") {
            if (eleccion2 === "piedra") {alert("Gana papel"); return}
            else {alert("Gana tijera"); return}
            }
        else {
            if (eleccion2 === "piedra") {alert("Gana piedra"); return}
            else {alert("Gana tijera"); return}
            }

    };
        comparar(usuarioElige, computadoraElige);
}
