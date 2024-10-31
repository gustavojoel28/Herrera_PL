function abrirNuevaDenuncia() {
    const modalNueva = document.getElementById('modal-nueva');
    const iframeNueva = document.getElementById('iframe-nueva');
    iframeNueva.src = 'Vista/formulario_nueva_denuncia.php'; // Solo asigna el src cuando se abre el modal
    modalNueva.style.display = 'flex'; // Muestra el modal
}

function cerrarModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';

    // Limpia el src del iframe para evitar recargas automáticas no deseadas
    if (modalId === 'modal-nueva') {
        document.getElementById('iframe-nueva').src = '';
    } else if (modalId === 'modal-editar') {
        document.getElementById('iframe-editar').src = '';
    }
}



function abrirEditarDenuncia(id) {
    const modalEditar = document.getElementById('modal-editar');
    const iframeEditar = document.getElementById('iframe-editar');
    iframeEditar.src = `Vista/formulario_editar_denuncia.php?id=${id}`; // Cargar el formulario de edición con el ID
    modalEditar.style.display = 'flex'; // Mostrar el modal de edición
}


// Cerrar el modal al hacer clic fuera del contenido
window.onclick = function(event) {
    const modalNueva = document.getElementById('modal-nueva');
    const modalEditar = document.getElementById('modal-editar');

    if (event.target === modalNueva) {
        cerrarModal('modal-nueva');
    } else if (event.target === modalEditar) {
        cerrarModal('modal-editar');
    }
}

// Confirmación para eliminar una denuncia
function eliminarDenuncia(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta denuncia?')) {
        window.location.href = `Controlador/DenunciaController.php?eliminar=${id}`;
    }
}

function cerrarModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';

    // Limpia el src del iframe para que no vuelva a cargarse automáticamente
    if (modalId === 'modal-nueva') {
        document.getElementById('iframe-nueva').src = '';
    } else if (modalId === 'modal-editar') {
        document.getElementById('iframe-editar').src = '';
    }
}

function recargarListaDenuncias() {
    fetch('Vista/obtener_denuncias.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('lista-denuncias').innerHTML = html;
        })
        .catch(error => console.error('Error al recargar la lista de denuncias:', error));
}

function buscarDenuncia() {
    const titulo = document.getElementById('busquedaDenuncia').value;
    fetch(`Vista/obtener_denuncias.php?titulo=${titulo}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('lista-denuncias').innerHTML = html;
        })
        .catch(error => console.error('Error al buscar la denuncia:', error));
}

function restablecerDenuncias() {
    document.getElementById('busquedaDenuncia').value = ''; // Limpiar el campo de búsqueda
    recargarListaDenuncias(); // Llamar a la función para recargar todas las denuncias
}

