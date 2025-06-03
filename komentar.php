<?php
// Include file koneksi
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = pg_escape_string($conn, $_POST['nama']);
    $komentar = pg_escape_string($conn, $_POST['komentar']);

    $query = "INSERT INTO komentar (nama, komentar) VALUES ('$nama', '$komentar')";

    $result = pg_query($conn, $query);

    if ($result) {
        header("Location: gallery.html"); // Setelah berhasil, kembali ke halaman gallery
        exit;
    } else {
        echo "Error saat menyimpan komentar: " . pg_last_error($conn);
    }
}

// Tidak perlu pg_close($conn), tapi boleh kalau mau:
pg_close($conn);
?>
