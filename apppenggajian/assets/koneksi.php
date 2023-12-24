<?php
$host     = "localhost";
$username = "root";
$password = "1234";
$database = "penggajian";

$konek = mysqli_connect($host, $username, $password, $database);

// Cek koneksi mysqli_connect_errno()
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengatur karakter set koneksi
mysqli_set_charset($konek, "utf8");
?>
