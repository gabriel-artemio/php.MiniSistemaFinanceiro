<?php
require_once('../config/db.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>