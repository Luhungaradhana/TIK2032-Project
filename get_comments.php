<?php
// File untuk mengambil komentar untuk gambar tertentu
include 'koneksi.php';

if (isset($_GET['id_gambar'])) {
    $id_gambar = (int)$_GET['id_gambar'];
    
    // Query untuk mengambil komentar untuk gambar tertentu
    $query = "SELECT * FROM komentar WHERE id_gambar = $id_gambar ORDER BY tanggal DESC";
    $result = pg_query($conn, $query);
    
    $comments = array();
    
    if ($result && pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $comments[] = array(
                'id' => $row['id'],
                'nama' => $row['nama'],
                'komentar' => $row['komentar'],
                'tanggal' => $row['tanggal']
            );
        }
    }
    
    // Kembalikan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($comments);
} else {
    // Jika tidak ada id_gambar, kembalikan array kosong
    header('Content-Type: application/json');
    echo json_encode(array());
}

// Tutup koneksi
pg_close($conn);
?>