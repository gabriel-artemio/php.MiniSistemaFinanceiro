<?php
include('../auth/verifica.php');
include('../includes/header.php');
require_once('../config/db.php');

if ($_POST) {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];

    $sql = "INSERT INTO transacoes (descricao, valor, tipo, data)
            VALUES ('$descricao', '$valor', '$tipo', '$data')";

    mysqli_query($conn, $sql);

    header("Location: listar.php");
}
?>

<div class="container">
  <form class="mt-3" method="POST">
        <h3>Criar Transação</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><b>Descrição</b></label>
            <input type="text" class="form-control" name="descricao">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Valor</b></label>
            <input  class="form-control" name="valor" type="number" step="0.01">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Tipo da Transação</b></label>
            <select  class="form-control" name="tipo">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"><b>Data da Transação</b></label>
            <input  class="form-control" type="date" name="data">
        </div>
        <button type="submit" class="btn btn-success">
            Salvar <i class="bi bi-save"></i>
        </button>
        <a href="listar.php" class="btn btn-secondary">
            Voltar
        </a>
    </form>
</div>