function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const contenidoPrincipal = document.querySelector('.contenido-principal');
    sidebar.classList.toggle('oculta');
    contenidoPrincipal.classList.toggle('ancho-completo');
}
