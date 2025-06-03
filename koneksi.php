<?php
$host = "localhost";
$port = "5432";
$dbname = "website_sederhana"; // ganti jika nama databasenya beda
$user = "postgres";
$password = "123456789"; // sesuai milikmu

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Koneksi gagal.";
    exit;
}
?>
