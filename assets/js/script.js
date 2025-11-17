// assets/js/script.js

/**
 * Menampilkan popup SweetAlert2 untuk konfirmasi hapus.
 * @param {string} id - ID tugas yang akan dihapus.
 * @param {string} taskName - Nama tugas yang akan dihapus.
 * @returns {boolean} - Selalu mengembalikan false untuk mencegah aksi tautan default.
 */
function showDeleteConfirmation(id, taskName) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `Apakah Anda yakin ingin menghapus tugas: <b>"${taskName}"</b>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545', // Merah
        cancelButtonColor: '#6c757d', // Abu-abu
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengklik "Ya, Hapus!", lakukan redirection ke aksi delete
            window.location.href = `index.php?action=delete&id=${id}`;
        }
    });

    return false; // Mencegah tautan berjalan secara default
}

// Anda bisa menghapus fungsi confirmDelete() lama.