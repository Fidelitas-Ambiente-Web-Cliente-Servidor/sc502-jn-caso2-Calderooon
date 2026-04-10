public function solicitar()
{
    if (!isset($_SESSION['id'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Debes iniciar sesión'
        ]);
        return;
    }

    $tallerId = $_POST['taller_id'] ?? 0;
    $usuarioId = $_SESSION['id'];

    // 🔴 Validar que venga el ID
    if ($tallerId == 0) {
        echo json_encode([
            'success' => false,
            'error' => 'Taller inválido'
        ]);
        return;
    }

    // 🔴 1. Validar duplicado
    if ($this->solicitudModel->existeSolicitud($usuarioId, $tallerId)) {
        echo json_encode([
            'success' => false,
            'error' => 'Ya solicitaste este taller'
        ]);
        return;
    }

    // 🔴 2. Validar cupo disponible
    $taller = $this->tallerModel->getById($tallerId);

    if (!$taller || $taller['cupo_disponible'] <= 0) {
        echo json_encode([
            'success' => false,
            'error' => 'No hay cupo disponible'
        ]);
        return;
    }

    // 🔴 3. Insertar solicitud
    $resultado = $this->solicitudModel->crear($tallerId, $usuarioId);

    if ($resultado) {
        echo json_encode([
            'success' => true,
            'message' => 'Solicitud enviada correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Error al registrar solicitud'
        ]);
    }
}