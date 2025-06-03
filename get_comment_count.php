<?php
// File untuk menghitung jumlah komentar untuk gambar tertentu
include 'koneksi.php';

if (isset($_GET['id_gambar'])) {
    $id_gambar = (int)$_GET['id_gambar'];
    
    // Query untuk menghitung komentar untuk gambar tertentu
    $query = "SELECT COUNT(*) as total FROM komentar WHERE id_gambar = $id_gambar";
    $result = pg_query($conn, $query);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        echo $row['total'];
    } else {
        echo '0';
    }
} else {
    echo '0';
}

// Tutup koneksi
pg_close($conn);
?>