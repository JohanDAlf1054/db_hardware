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
//Evento para mostrar y ocultar menú
function open_close_menu() {
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");
    // liPanel.classList.toggle("liPanel");
    // onlinePanel.classList.toggle("onlinePanel");

    // Ocultar los elementos .li y .online cuando se cierra el menú
    if (body.classList.contains("body_move")) {
        liPanel.style.display = 'block';
        onlinePanel.style.display = 'block';
        liPanel1.style.display = 'block';
        onlinePanel1.style.display = 'block';
    } else {
        liPanel.style.display = 'none';
        onlinePanel.style.display = 'none';
        liPanel1.style.display = 'none';
        onlinePanel1.style.display = 'none';
    }
}

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

        body.classList.remove("body_move");
        side_menu.classList.remove("menu__side_move");

        liPanel.style.display = 'none';
        onlinePanel.style.display = 'none';
        liPanel1.style.display = 'none';
        onlinePanel1.style.display = 'none';
    }

    if (window.innerWidth < 760) {

        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");

         // Ocultar los elementos .li y .online cuando la pantalla es más pequeña
         if (body.classList.contains("body_move")) {
            liPanel.style.display = 'none';
            onlinePanel.style.display = 'none';
            liPanel1.style.display = 'none';
            onlinePanel1.style.display = 'none';
        } else {
            liPanel.style.display = 'block';
            onlinePanel.style.display = 'block';
            liPanel1.style.display = 'block';
            onlinePanel1.style.display = 'block';
        }
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


