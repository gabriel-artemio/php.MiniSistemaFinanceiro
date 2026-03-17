<?php
include('../auth/verifica.php');
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

<form method="POST">
    <input name="descricao" placeholder="Descrição"><br>
    <input name="valor" type="number" step="0.01"><br>

    <select name="tipo">
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select><br>

    <input type="date" name="data"><br>

    <button>Salvar</button>
</form>