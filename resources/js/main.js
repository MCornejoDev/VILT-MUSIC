import * as jQuery from "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js";
// Importa Bootstrap y Popper.js
import 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js';
import 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js';
// Importa Material Design Bootstrap (MDB)
import 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.20.0/js/mdb.min.js';
import "https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.2/sweetalert2.min.js";

window.$ = window.jQuery = jQuery;

// Selecciona el botón del menú móvil y el menú móvil 
const mobileMenuButton = document.querySelector('#mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

// Añade un event listener al botón
mobileMenuButton.addEventListener('click', () => {
    // Alterna la clase 'hidden' y la opacidad
    if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
        mobileMenu.classList.add('opacity-100');
        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px'; // Ajusta la altura máxima
    } else {
        mobileMenu.classList.add('opacity-0');
        mobileMenu.style.maxHeight = '0'; // Establece la altura máxima a 0
        setTimeout(() => {
            mobileMenu.classList.add('hidden'); // Oculta el menú después de la transición
        }, 200); // Duración de la transición
    }
});

// Inicializa el menú móvil oculto al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    mobileMenu.classList.add('hidden');
    mobileMenu.classList.add('opacity-0');
});