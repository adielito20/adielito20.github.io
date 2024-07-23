
/* SLIDER */
/* llamamos con la clase que tiene el display*/

const carruselp = document.querySelector('.carruselp-items');

let maxScrolLeft = carruselp.scrollWidth -carruselp.clientWidth;
/* Intervalo para el desplazamiento (mov - stop)*/
let intervalo = null;
let step = 2;


const start = () => {
    intervalo = setInterval(function(){
        carruselp.scrollLeft = carruselp.scrollLeft + step;
        if(carruselp.scrollLeft > carruselp.offsetWidth) {
            step = step * -1;
        }else if (carruselp.scrollLeft == 0) {
            step = step * - 1;
        }
    }, 10);
}


const stop = () => {
    clearInterval(intervalo);
};

carruselp.addEventListener('mouseover', () => {
    stop();
});

carruselp.addEventListener('mouseout', () => {
    start();
});

/* ejecutamos método */
start();


/* INICIO DE SESION */

function login(){
    var usuario, password

    usuario = document.getElementById("usuario").value;
    password = document.getElementById("contrasenia").value;

    if( usuario == "omar.leon@gmail.com" && password == "123"){
        alert("Iniciaste Sesión")
        
    }else{
        alert("Datos incorrectos")
    }

};


