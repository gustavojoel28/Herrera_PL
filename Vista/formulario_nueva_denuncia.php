<link rel="stylesheet" href="../Configuraciones/styles.css">
<h2>Nueva Denuncia</h2>
<form id="form-nueva-denuncia" action="../Controlador/DenunciaController.php" method="post" class="form-denuncia">
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
    </div>
    <div class="form-group">
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" required>
    </div>
    <div class="form-group">
        <label for="ciudadano">Ciudadano:</label>
        <input type="text" id="ciudadano" name="ciudadano" required>
    </div>
    <div class="form-group">
        <label for="telefono_ciudadano">Teléfono:</label>
        <input type="text" id="telefono_ciudadano" name="telefono_ciudadano" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="en proceso">En proceso</option>
            <option value="resuelto">Resuelto</option>
        </select>
    </div>
    <div class="form-group form-group-btn">
        <button type="submit" class="btn-guardar">Guardar</button>
        <button type="button" onclick="parent.cerrarModal('modal-nueva')" class="btn-cancelar">Cerrar</button>
    </div>
</form>

<script>
    document.getElementById('form-nueva-denuncia').onsubmit = function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                // Cerrar el modal y recargar la lista de denuncias en la página principal
                parent.cerrarModal('modal-nueva');
                parent.recargarListaDenuncias(); // Recarga la lista sin recargar toda la página
            } else {
                alert("Hubo un problema al guardar la denuncia.");
            }
        })
        .catch(error => console.error('Error:', error));
    };
</script>



