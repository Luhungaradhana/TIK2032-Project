<?php
require 'koneksi.php'; // pastikan koneksi PostgreSQL

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    $result = pg_query($conn, "SELECT * FROM artikel ORDER BY id DESC");
    $rows = pg_fetch_all($result);
    echo json_encode($rows ?: []);
} elseif ($method === 'POST') {
    $judul = $data['judul'];
    $konten = $data['konten'];
    pg_query_params($conn, "INSERT INTO artikel (judul, konten) VALUES ($1, $2)", [$judul, $konten]);
    echo json_encode(['status' => 'Artikel ditambahkan']);
} elseif ($method === 'PUT') {
    $id = $data['id'];
    $judul = $data['judul'];
    $konten = $data['konten'];
    pg_query_params($conn, "UPDATE artikel SET judul=$1, konten=$2 WHERE id=$3", [$judul, $konten, $id]);
    echo json_encode(['status' => 'Artikel diperbarui']);
} elseif ($method === 'DELETE') {
    $id = $data['id'];
    pg_query_params($conn, "DELETE FROM artikel WHERE id=$1", [$id]);
    echo json_encode(['status' => 'Artikel dihapus']);
}
