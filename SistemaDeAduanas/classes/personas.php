// Obtiene una persona específica por su ID para llenar el formulario al editar
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM personas WHERE id_persona = :id");
        $stmt->execute([':id' => $id]);
        $resultado = $stmt->fetch();
        return $resultado ?: null;
    }

    // Actualiza los datos de una persona existente
    public function actualizar(array $datos): bool {
        $sql = "UPDATE personas 
                SET documento = :documento, nombre = :nombre, apellido = :apellido, telefono = :telefono 
                WHERE id_persona = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':documento' => strip_tags($datos['documento']),
            ':nombre'    => strip_tags($datos['nombre']),
            ':apellido'  => strip_tags($datos['apellido']),
            ':telefono'  => strip_tags($datos['telefono'] ?? ''),
            ':id'        => (int)$datos['id_persona']
        ]);
    }

    // Elimina una persona de forma segura
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM personas WHERE id_persona = :id");
        return $stmt->execute([':id' => $id]);
    }