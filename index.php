<?php
// index.php
/**
* File ini adalah titik awal dari aplikasi.
*
* Ia menggunakan kelas TodoController untuk menangani berbagai aksi
* dan kemudian merender tampilan dengan daftar tugas.
*/
// Memanggil file TodoController.php untuk menggunakan class TodoController
require_once 'controllers/TodoController.php';
$controller = new TodoController();
$action = $_GET['action'] ?? null;

// Menangani parameter aksi
switch ($action) {
    case 'add':
        // Dapatkan tugas dari request
        $task = $_POST['task'] ?? '';
        // Tambahkan tugas ke daftar
        $controller->add($task);
        // Redirect setelah aksi untuk mencegah resubmission form
        header('Location: index.php'); 
        exit();
        break;
        
    case 'complete':
        // Dapatkan id dari request
        $id = $_GET['id'] ?? '';
        // Tandai tugas sebagai selesai
        $controller->markAsCompleted($id);
        // Redirect
        header('Location: index.php'); 
        exit();
        break;
        
    case 'delete':
        // Dapatkan id dari request
        $id = $_GET['id'] ?? '';
        // Hapus tugas dari daftar
        $controller->delete($id);
        // Redirect
        header('Location: index.php');
        exit();
        break;
        
    case 'edit': // FUNGSI BARU: Menampilkan form edit
        $id = $_GET['id'] ?? '';
        $todo_data = $controller->edit($id); // Ambil data todo berdasarkan ID
        
        // Render tampilan edit alih-alih list
        require 'views/editTodo.php';
        exit(); // Hentikan eksekusi setelah merender view edit
        break;
        
    case 'update': // FUNGSI BARU: Menyimpan perubahan
        $id = $_GET['id'] ?? '';
        $task = $_POST['task'] ?? '';
        
        $controller->update($id, $task);
        // Redirect setelah update
        header('Location: index.php');
        exit();
        break;
}

// Dapatkan teks pencarian dari request
$search = $_GET['search'] ?? null;

// Dapatkan daftar tugas, meneruskan parameter pencarian
$todos = $controller->index($search);

// Merender tampilan
require 'views/listTodos.php';
?>