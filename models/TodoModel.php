<?php
// models/TodoModel.php
require_once 'config/Database.php'; // Path dikoreksi relatif dari models/ ke config/

class TodoModel {
    private $conn;
    public $table_name = "todos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Mendapatkan semua todo yang ada di database, dengan opsi pencarian.
     *
     * @param string|null $search Teks pencarian (opsional)
     * @return array
     */
    public function getTodoById($id) {
    $query = "SELECT id, task FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function getAllTodos($search = null) {
        $query = "SELECT * FROM " . $this->table_name;
        $conditions = [];
        
        // Tambahkan kondisi WHERE jika ada teks pencarian
        if ($search) {
            $conditions[] = "task LIKE :search";
        }

        // Gabungkan kondisi
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $query .= " ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($query);

        // Bind parameter pencarian jika ada
        if ($search) {
            $searchTerm = "%{$search}%";
            $stmt->bindParam(":search", $searchTerm);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createTodo($task) {
        $query = "INSERT INTO " . $this->table_name . " (task) VALUES (:task)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":task", $task);
        return $stmt->execute();
    }

    public function updateTodoStatus($id, $is_completed) {
        $query = "UPDATE " . $this->table_name . " SET is_completed = :is_completed WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":is_completed", $is_completed);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    
    /**
     * Memperbarui teks tugas (task) todo. (FUNGSI BARU UNTUK UPDATE)
     *
     * @param int $id ID dari todo yang akan diperbarui
     * @param string $task Teks tugas baru
     * @return boolean
     */
    public function updateTodoTask($id, $task) {
        $query = "UPDATE " . $this->table_name . " SET task = :task WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":task", $task);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteTodo($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>