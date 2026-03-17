<?php
include('../auth/verifica.php');
require_once('../config/db.php');

$id = $_GET['id'];

if ($_POST) {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];

    mysqli_query($conn, "UPDATE transacoes 
        SET descricao='$descricao', valor='$valor', tipo='$tipo'
        WHERE id=$id");

    header("Location: listar.php");
}

$result = mysqli_query($conn, "SELECT * FROM transacoes WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<form method="POST">
    <input name="descricao" value="<?= $row['descricao'] ?>"><br>
    <input name="valor" value="<?= $row['valor'] ?>"><br>

    <select name="tipo">
        <option value="entrada" <?= $row['tipo']=='entrada'?'selected':'' ?>>Entrada</option>
        <option value="saida" <?= $row['tipo']=='saida'?'selected':'' ?>>Saída</option>
    </select>

    <button>Atualizar</button>
</form>