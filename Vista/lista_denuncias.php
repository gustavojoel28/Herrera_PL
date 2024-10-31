<?php
require_once 'Controlador/DenunciaController.php';
$controller = new DenunciaController();
$denuncias = $controller->listarDenuncias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Denuncias</title>
    <link rel="stylesheet" href="Configuraciones/styles.css">
</head>
<body>
    <h2>Denuncias</h2>
    <div class="acciones-denuncias">
        <input type="text" id="busquedaDenuncia" placeholder="Buscar denuncia por título">
        <button class="btn-accion" onclick="buscarDenuncia()">Buscar</button>
        <button class="btn-accion" onclick="restablecerDenuncias()">Restablecer</button>
        <button class="btn-accion" onclick="abrirNuevaDenuncia()">Nueva Denuncia</button>
    </div>
    
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Ciudadano</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="lista-denuncias">
        <?php include 'Vista/obtener_denuncias.php'; ?>
    </tbody>
</table>

<!-- Modal para Nueva Denuncia -->
<div id="modal-nueva" class="modal" style="display: none;">
    <div class="modal-content">
        <span onclick="cerrarModal('modal-nueva')" class="close">&times;</span>
        <iframe id="iframe-nueva" src="" width="100%" height="400px" style="border:none;"></iframe>
    </div>
</div>

<!-- Modal para Editar Denuncia -->
<div id="modal-editar" class="modal" style="display: none;">
    <div class="modal-content">
        <span onclick="cerrarModal('modal-editar')" class="close">&times;</span>
        <iframe id="iframe-editar" src="" width="100%" height="400px" style="border:none;"></iframe>
    </div>
</div>


    <!-- Script para manejar los modales -->
    <script src="Configuraciones/script.js"></script>
</body>
</html>
