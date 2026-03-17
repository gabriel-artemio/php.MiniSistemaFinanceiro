<?php
$conn = mysqli_connect("localhost", "root", "arlabs", "php_pdo");

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>