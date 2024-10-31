<?php
require_once __DIR__ . '/../Modelo/Denuncia.php';

class DenunciaController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Denuncia();
    }

    // Listar todas las denuncias
    public function listarDenuncias() {
        return $this->modelo->obtenerDenuncias();
    }

    // Buscar denuncias por título
    public function buscarDenunciaPorTitulo($titulo) {
        return $this->modelo->buscarDenunciaPorTitulo($titulo);
    }

    // Guardar denuncia (creación o actualización según el ID)
    public function guardarDenuncia($data) {
        if (isset($data['id']) && !empty($data['id'])) {
            return $this->modelo->actualizarDenuncia($data);
        } else {
            return $this->modelo->agregarDenuncia($data);
        }
    }

    // Eliminar denuncia
    public function eliminarDenuncia($id) {
        return $this->modelo->eliminarDenuncia($id);
    }
}

// Procesar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new DenunciaController();
    $resultado = $controller->guardarDenuncia($_POST);

    if ($resultado) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
} elseif (isset($_GET['eliminar'])) {
    $controller = new DenunciaController();
    $controller->eliminarDenuncia($_GET['eliminar']);
    header('Location: ../index.php');
    exit;
} elseif (isset($_GET['titulo'])) {
    $controller = new DenunciaController();
    $titulo = $_GET['titulo'];
    $denuncias = $controller->buscarDenunciaPorTitulo($titulo);

    include __DIR__ . '/../Vista/obtener_denuncias.php';
    exit;
}
?>
