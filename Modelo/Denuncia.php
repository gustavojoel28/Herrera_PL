<?php
require_once __DIR__ . '/../Configuraciones/conexion.php';

class Denuncia {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    public function obtenerDenuncias() {
        $sql = "SELECT * FROM denuncias";
        return $this->conexion->query($sql);
    }

    public function agregarDenuncia($data) {
        $sql = "INSERT INTO denuncias (titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$data['titulo'], $data['descripcion'], $data['ubicacion'], $data['estado'], $data['ciudadano'], $data['telefono_ciudadano']]);
    }

    public function actualizarDenuncia($data) {
        $sql = "UPDATE denuncias SET titulo = ?, descripcion = ?, ubicacion = ?, estado = ?, ciudadano = ?, telefono_ciudadano = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$data['titulo'], $data['descripcion'], $data['ubicacion'], $data['estado'], $data['ciudadano'], $data['telefono_ciudadano'], $data['id']]);
    }

    public function eliminarDenuncia($id) {
        $sql = "DELETE FROM denuncias WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$id]);
    }

     // Método para obtener una denuncia específica por su ID
     public function obtenerDenunciaPorId($id) {
        $sql = "SELECT * FROM denuncias WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para buscar denuncias por título
    public function buscarDenunciaPorTitulo($titulo) {
        $sql = "SELECT * FROM denuncias WHERE titulo LIKE ?";
        $stmt = $this->conexion->prepare($sql);  // Usa directamente $this->conexion
        $stmt->execute(["%$titulo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
?>

