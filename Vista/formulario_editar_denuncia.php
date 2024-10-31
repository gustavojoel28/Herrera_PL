<link rel="stylesheet" href="../Configuraciones/styles.css">
<?php
require_once __DIR__ . '/../Modelo/Denuncia.php';
$denuncia = new Denuncia();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$denunciaData = null;

if ($id) {
    $denunciaData = $denuncia->obtenerDenunciaPorId($id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Denuncia</title>
    <script>
        function enviarFormularioEdicion(event) {
            event.preventDefault(); // Evitar el envío tradicional del formulario

            const form = document.getElementById('form-editar-denuncia');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'success') {
                    // Cerrar el modal de edición
                    parent.cerrarModal('modal-editar');

                    // Recargar la lista de denuncias en la página principal
                    parent.recargarListaDenuncias();
                } else {
                    alert("Hubo un problema al guardar los cambios.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
<h2>Editar Denuncia</h2>
<?php if ($denunciaData): ?>
    <form id="form-editar-denuncia" action="../Controlador/DenunciaController.php" method="post" onsubmit="enviarFormularioEdicion(event)">
        <!-- Campo oculto para enviar el ID de la denuncia -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($denunciaData['titulo']) ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($denunciaData['descripcion']) ?></textarea>

        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" value="<?= htmlspecialchars($denunciaData['ubicacion']) ?>" required>

        <label for="ciudadano">Ciudadano:</label>
        <input type="text" id="ciudadano" name="ciudadano" value="<?= htmlspecialchars($denunciaData['ciudadano']) ?>" required>

        <label for="telefono_ciudadano">Teléfono:</label>
        <input type="text" id="telefono_ciudadano" name="telefono_ciudadano" value="<?= htmlspecialchars($denunciaData['telefono_ciudadano']) ?>" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente" <?= $denunciaData['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="en proceso" <?= $denunciaData['estado'] === 'en proceso' ? 'selected' : '' ?>>En proceso</option>
            <option value="resuelto" <?= $denunciaData['estado'] === 'resuelto' ? 'selected' : '' ?>>Resuelto</option>
        </select>

        <button type="submit">Guardar Cambios</button>
    </form>
<?php else: ?>
    <p>No se encontró la denuncia.</p>
<?php endif; ?>

</body>
</html>
