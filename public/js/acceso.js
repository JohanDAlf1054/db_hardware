//Ejecutar función en el evento click
document.getElementById("btn_open").addEventListener("click", open_close_menu);

//Declaramos variables
var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");
var liPanel = document.getElementById("liPanel"); // Elemento con clase .li
var onlinePanel = document.getElementById("onlinePanel"); // Elemento con clase .online
var liPanel1 = document.getElementById("liPanel1"); // Elemento con clase .li
var onlinePanel1 = document.getElementById("onlinePanel1");

liPanel.style.display = 'none';
onlinePanel.style.display = 'none';
liPanel1.style.display = 'none';
onlinePanel1.style.display = 'none';

function open_close_menu() {
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");

    // Si la barra lateral está abierta (es decir, body NO tiene la clase body_move)
    if (!body.classList.contains("body_move")) {
        liPanel.style.display = 'none';
        onlinePanel.style.display = 'none';
        liPanel1.style.display = 'none';
        onlinePanel1.style.display = 'none';

        // Ocultar solo los elementos h4 y las imágenes dentro de .option
        var textElements = document.querySelectorAll('.option h4');
        var imgElements = document.querySelectorAll('.option img');
        for (var i = 0; i < textElements.length; i++) {
            textElements[i].style.opacity = '0';
        }
        for (var i = 0; i < imgElements.length; i++) {
            imgElements[i].style.opacity = '0';
        }

        // Si no funciona funemos a brayan
        var namePageImg = document.querySelector('.name__page img');
        namePageImg.style.opacity = '0';
        namePageImg.style.visibility = 'hidden';

        side_menu.style.borderRight = '3px solid rgb(104, 104, 104)';
    } else {
        // Si la barra lateral está cerrada (es decir, body SÍ tiene la clase body_move)
        liPanel.style.display = 'block';
        onlinePanel.style.display = 'block';
        liPanel1.style.display = 'block';
        onlinePanel1.style.display = 'block';

        // Mostramos los elementos h4 y las imágenes cuando la barra lateral está cerrada
        var textElements = document.querySelectorAll('.option h4');
        var imgElements = document.querySelectorAll('.option img');
        for (var i = 0; i < textElements.length; i++) {
            textElements[i].style.opacity = '1';
        }
        for (var i = 0; i < imgElements.length; i++) {
            imgElements[i].style.opacity = '1';
        }

        // Este bloque es para mostrar la imagen normal cuando la barra esta abierta
        var namePageImg = document.querySelector('.name__page img');
        namePageImg.style.opacity = '1';
        namePageImg.style.visibility = 'visible';
    }
}



open_close_menu();

document.getElementById("btn_open").addEventListener("click", open_close_menu);


//Si el ancho de la página es menor a 760px, ocultará el menú al recargar la página

if (window.innerWidth < 760) {

    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");

    // Ocultar los elementos .li y .online cuando la página se carga con el menú cerrado
    liPanel.style.display = 'none';
    onlinePanel.style.display = 'none';
    liPanel1.style.display = 'none';
    onlinePanel1.style.display = 'none';
}

//Haciendo el menú responsive(adaptable)

window.addEventListener("resize", function () {

    if (window.innerWidth > 760) {

        open_close_menu(); // Llama a la función para abrir el menú

    }

    if (window.innerWidth < 760) {

        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");

        // Ocultar los elementos .li y .online cuando la pantalla es más pequeña
        liPanel.style.display = 'none';
        onlinePanel.style.display = 'none';
        liPanel1.style.display = 'none';
        onlinePanel1.style.display = 'none';
    }

});

function showSettingsMenu() {
    var settingsMenu = document.getElementById('settings-menu');
    settingsMenu.style.display = 'block';
}

function hideSettingsMenu() {
    var settingsMenu = document.getElementById('settings-menu');
    settingsMenu.style.display = 'none';

}



// Funcion para aumentar la letra
document.addEventListener('DOMContentLoaded', function() {
    var fontLargerButton = document.querySelector('#font-larger-button');
    var fontIncreaseStep = 1;
    if (fontLargerButton) {
    fontLargerButton.addEventListener('click', function(e) {
        e.preventDefault();
        document.body.classList.remove(`font-increase-${fontIncreaseStep}`);
        fontIncreaseStep = (fontIncreaseStep % 4) + 1;
        document.body.classList.add(`font-increase-${fontIncreaseStep}`);
    });
    }
});

//Funcion para disminuir la letra
document.addEventListener('DOMContentLoaded', function() {
    var fontDecreaseButton = document.querySelector('#font-smaller-button');
    var fontDecreaseStep = 1;
    if (fontDecreaseButton) {
        fontDecreaseButton.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.remove(`font-decrease-${fontDecreaseStep}`);
            fontDecreaseStep = (fontDecreaseStep % 4) + 1; // Cambia de pasos que va a dar 4
            document.body.classList.add(`font-decrease-${fontDecreaseStep}`);
        });
    }
});

//Funcion para alto contraste
document.addEventListener('DOMContentLoaded', function(){
    var altoContrasteButton = document.querySelector('#alto-contraste-button');
    if(altoContrasteButton){
        altoContrasteButton.addEventListener('click', function(e){
            e.preventDefault();
            document.documentElement.classList.toggle('alto-contraste');
        });
    }
});


