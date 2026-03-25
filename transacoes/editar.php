<?php
include('../auth/verifica.php');
include('../includes/header.php');
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

<div class="container">
    <h3>Editar Transação</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Data da Transação</b></label>
            <input class="form-control" name="descricao" value="<?= $row['descricao'] ?>">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Data da Transação</b></label>
            <input class="form-control" name="valor" value="<?= $row['valor'] ?>">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Data da Transação</b></label>
            <select class="form-control" name="tipo">
                <option value="entrada" <?= $row['tipo']=='entrada'?'selected':'' ?>>Entrada</option>
                <option value="saida" <?= $row['tipo']=='saida'?'selected':'' ?>>Saída</option>
            </select>
        </div>

        <button class="btn btn-success">
            Atualizar Dados <i class="bi bi-save"></i>
        </button>
    </form>
</div>