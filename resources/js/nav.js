// resources/js/nav.js
export function initMobileMenu() {
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
}
