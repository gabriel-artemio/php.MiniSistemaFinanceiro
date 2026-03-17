<?php
require_once('../auth/verifica.php');
require_once('../config/db.php');

// ===== RESUMO =====
$sqlResumo = "
SELECT 
    SUM(CASE WHEN tipo='entrada' THEN valor ELSE 0 END) as entradas,
    SUM(CASE WHEN tipo='saida' THEN valor ELSE 0 END) as saidas
FROM transacoes
";

$res = mysqli_query($conn, $sqlResumo);
$dataResumo = mysqli_fetch_assoc($res);

$entradas = $dataResumo['entradas'] ?? 0;
$saidas = $dataResumo['saidas'] ?? 0;
$saldo = $entradas - $saidas;


// ===== DADOS DO GRÁFICO (últimos meses) =====
$sqlGrafico = "
SELECT 
    DATE_FORMAT(data, '%Y-%m') as mes,
    SUM(CASE WHEN tipo='entrada' THEN valor ELSE 0 END) as entradas,
    SUM(CASE WHEN tipo='saida' THEN valor ELSE 0 END) as saidas
FROM transacoes
GROUP BY mes
ORDER BY mes ASC
";

$resultGrafico = mysqli_query($conn, $sqlGrafico);

$labels = [];
$entradasData = [];
$saidasData = [];

while($row = mysqli_fetch_assoc($resultGrafico)) {
    $labels[] = $row['mes'];
    $entradasData[] = $row['entradas'];
    $saidasData[] = $row['saidas'];
}

include('../includes/header.php');
?>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4>Financeiro</h4>
        <hr>

        <a href="#" class="d-block text-white mb-2">Dashboard</a>
        <a href="../transacoes/listar.php" class="d-block text-white mb-2">Transações</a>

        <hr>
        <a href="../auth/logout.php" class="text-danger">Sair</a>
    </div>

    <!-- CONTEÚDO -->
    <div class="container-fluid p-4">

        <!-- TOPO -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard</h2>

            <div>
                Olá, <strong><?= $_SESSION['usuario'] ?></strong>
            </div>
        </div>

        <!-- CARDS -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Entradas</h6>
                        <h4>R$ <?= number_format($entradas, 2, ',', '.') ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>Saídas</h6>
                        <h4>R$ <?= number_format($saidas, 2, ',', '.') ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Saldo</h6>
                        <h4>R$ <?= number_format($saldo, 2, ',', '.') ?></h4>
                    </div>
                </div>
            </div>

        </div>

        <!-- GRÁFICO -->
        <div class="card p-3">
            <h5>Fluxo financeiro mensal</h5>
            <canvas id="grafico"></canvas>
        </div>

    </div>

</div>

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('grafico');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [
            {
                label: 'Entradas',
                data: <?= json_encode($entradasData) ?>,
                borderWidth: 2,
                tension: 0.3
            },
            {
                label: 'Saídas',
                data: <?= json_encode($saidasData) ?>,
                borderWidth: 2,
                tension: 0.3
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

<?php include('../includes/footer.php'); ?>