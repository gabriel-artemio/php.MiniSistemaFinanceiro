<?php
require_once('../auth/verifica.php');
require_once('../config/db.php');

$result = mysqli_query($conn, "SELECT * FROM transacoes ORDER BY id DESC");

include('../includes/header.php');
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Transações</h2>

        <div>
            <a href="criar.php" class="btn btn-success btn-sm">
                + Nova Transação
            </a>

            <a href="../dashboard/index.php" class="btn btn-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th width="180">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>

                    <td><?= htmlspecialchars($row['descricao']) ?></td>

                    <td>
                        R$ <?= number_format($row['valor'], 2, ',', '.') ?>
                    </td>

                    <td>
                        <?php if ($row['tipo'] == 'entrada') { ?>
                            <span class="badge bg-success">Entrada</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Saída</span>
                        <?php } ?>
                    </td>

                    <td>
                        <a href="editar.php?id=<?= $row['id'] ?>" 
                           class="btn btn-warning btn-sm">
                           Editar
                        </a>

                        <a href="excluir.php?id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Tem certeza que deseja excluir?')">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include('../includes/footer.php'); ?>