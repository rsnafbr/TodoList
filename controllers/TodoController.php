<?php
// controllers/TodoController.php
// Memanggil file TodoModel.php untuk menggunakan class TodoModel
require_once 'models/TodoModel.php';
/**
* Kelas yang bertanggung jawab untuk menangani permintaan terkait TodoItems
*/
class TodoController {
    /**
    * Instans dari TodoModel
    * @var TodoModel
    */
    private $model;

    /**
    * Konstruktor untuk kelas
    */
    public function __construct() {
        $this->model = new TodoModel();
    }

    /**
    * Mengembalikan semua todo, menerima parameter pencarian.
    * @param string|null $search Teks pencarian (opsional)
    * @return array Sebuah array dari semua todo
    */
    public function index($search = null) {
        // Meneruskan parameter pencarian ke Model
        return $this->model->getAllTodos($search);
    }

    /**
    * Membuat todo baru
    * @param string $task Teks dari tugas
    * @return array Todo yang baru dibuat
    */
    public function add($task) {
        return $this->model->createTodo($task);
    }

    /**
    * Menandai todo sebagai selesai
    * @param int $id ID dari todo yang akan ditandai sebagai selesai
    * @return array Todo yang diperbarui
    */
    public function markAsCompleted($id) {
        return $this->model->updateTodoStatus($id, 1);
    }
    
    /**
     * Mendapatkan satu todo berdasarkan ID untuk proses edit. (FUNGSI BARU UNTUK EDIT)
     * @param int $id ID dari todo
     * @return array Todo yang dicari
     */
    public function edit($id) {
        // Panggil fungsi getTodoById dari Model
    return $this->model->getTodoById($id);
    }

    /**
     * Memperbarui todo. (FUNGSI BARU UNTUK UPDATE)
     * @param int $id ID dari todo
     * @param string $task Teks tugas yang baru
     * @return boolean
     */
    public function update($id, $task) {
        return $this->model->updateTodoTask($id, $task);
    }

    /**
    * Menghapus todo
    * @param int $id ID dari todo yang akan dihapus
    * @return array Todo yang dihapus
    */
    public function delete($id) {
        return $this->model->deleteTodo($id);
    }
}