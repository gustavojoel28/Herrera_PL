<?php
require_once __DIR__ . '/../Controlador/DenunciaController.php';
$controller = new DenunciaController();

$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : null;

if ($titulo) {
    $denuncias = $controller->buscarDenunciaPorTitulo($titulo);
} else {
    $denuncias = $controller->listarDenuncias();
}

foreach ($denuncias as $denuncia) : ?>
    <tr>
        <td><?= htmlspecialchars($denuncia['id']) ?></td>
        <td><?= htmlspecialchars($denuncia['titulo']) ?></td>
        <td><?= htmlspecialchars($denuncia['descripcion']) ?></td>
        <td><?= htmlspecialchars($denuncia['ubicacion']) ?></td>
        <td><?= htmlspecialchars($denuncia['ciudadano']) ?></td>
        <td><?= htmlspecialchars($denuncia['fecha_registro']) ?></td>
        <td><?= htmlspecialchars($denuncia['estado']) ?></td>
        <td>
            <button class="btn-editar" onclick="abrirEditarDenuncia(<?= $denuncia['id'] ?>)">Editar</button>
            <button class="btn-eliminar" onclick="eliminarDenuncia(<?= $denuncia['id'] ?>)">Eliminar</button>
        </td>
    </tr>
<?php endforeach; ?>

