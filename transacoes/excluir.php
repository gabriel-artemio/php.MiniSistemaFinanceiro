<?php
include('../auth/verifica.php');
require_once('../config/db.php');

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM transacoes WHERE id=$id");

header("Location: listar.php");