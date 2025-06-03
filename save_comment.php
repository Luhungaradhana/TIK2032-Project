<?php
// File untuk menyimpan komentar baru
include 'koneksi.php';

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id_gambar = (int)$_POST['imageId'];
    $nama = pg_escape_string($conn, $_POST['nama']);
    $komentar = pg_escape_string($conn, $_POST['komentar']);
    
    // Query untuk menyimpan komentar ke database
    $query = "INSERT INTO komentar (id_gambar, nama, komentar, tanggal) VALUES ($id_gambar, '$nama', '$komentar', NOW())";
    $result = pg_query($conn, $query);
    
    if ($result) {
        echo "success";
    } else {
        echo "error: " . pg_last_error($conn);
    }
} else {
    echo "No data submitted";
}

// Tutup koneksi
pg_close($conn);
?>