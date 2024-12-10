

// Función para activar el elemento del menú
function activateItem(element) {
    // Remover la clase 'active' de todos los elementos del menú
    var menuItems = document.querySelectorAll('.nav-item');
    menuItems.forEach(function(item) {
        item.classList.remove('active', 'text-primary');
    });

    // Agregar la clase 'active' y 'text-primary' solo al elemento clickeado
    element.parentElement.classList.add('active');
    element.classList.add('text-primary');
}

// Obtener la URL actual
var currentPage = window.location.href.split('/').pop().split('#')[0].split('?')[0];

// Agregar la clase 'active' al elemento del menú correspondiente a la URL actual
var menuLinks = document.querySelectorAll('.nav-item a');
menuLinks.forEach(function(link) {
    if (link.getAttribute('href') === currentPage) {
        link.parentElement.classList.add('active');
        link.classList.add('text-primary');
    }
});
