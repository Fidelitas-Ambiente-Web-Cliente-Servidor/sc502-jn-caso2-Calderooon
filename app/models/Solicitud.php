<?php
class Solicitud
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function existeSolicitud($usuarioId, $tallerId)
    {
        $query = "SELECT id FROM solicitudes 
                  WHERE usuario_id = ? 
                  AND taller_id = ?
                  AND estado IN ('pendiente','aprobada')";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $usuarioId, $tallerId);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    public function crear($tallerId, $usuarioId)
    {
        $query = "INSERT INTO solicitudes (taller_id, usuario_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $tallerId, $usuarioId);
        return $stmt->execute();
    }

    public function getPendientes()
    {
        $query = "SELECT s.id, s.fecha_solicitud, s.estado,
                         u.username AS usuario,
                         t.nombre AS taller
                  FROM solicitudes s
                  JOIN usuarios u ON s.usuario_id = u.id
                  JOIN talleres t ON s.taller_id = t.id
                  WHERE s.estado = 'pendiente'
                  ORDER BY s.fecha_solicitud DESC";

        $result = $this->conn->query($query);

        $solicitudes = [];

        while ($row = $result->fetch_assoc()) {
            $solicitudes[] = $row;
        }

        return $solicitudes;
    }

    public function aprobar($id)
    {
        $query = "UPDATE solicitudes 
                  SET estado = 'aprobada'
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function rechazar($id)
    {
        $query = "UPDATE solicitudes 
                  SET estado = 'rechazada'
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM solicitudes WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}