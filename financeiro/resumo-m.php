<?php
session_start();
require_once("conexao.php");

if(isset($_GET['id_mes']) && !empty($_GET['id_mes'])) {
  $id_mes = $_GET['id_mes'];
  // Para a consulta de entradas
  $sql_entradas = "SELECT SUM (valor) AS total_entradas FROM movimentacao WHERE tipo = 'entrada AND id_mes = $id_mes";
  $result_entradas = mysqli_query($conn, $sql_entradas);
  if ($result_entradas) {
    $row_entradas = mysqli_fetch_assoc($resukt_entradas);
    $total_entradas = $row_entradas['total_entradas'];
  } else {
    $total_entradas = 0;
  }

  // Para a consulta de saidas
  $sql_saidas = "SELECT SUM (valor) AS total_saidas FROM movimentacao WHERE tipo = 'saida' AND id_mes = $id_mes";
  $result_saidas = mysqli_query($conn, $sql_saidas);
  if ($result_saidas) {
    $row_saidas = mysqli_fetch_assoc($result_saidas);
    $total_saidas = $row_saidas['total_saidas'];
  } else {
    $total_saidas = 0;
  }

  if ($saldo_final > 0) {
    // $saldo_cor = "text-sucess"; verde para positivo
  } elseif ($saldo_final < 0) {
    // $saldo_cor = "text-danger"; vermelha para negativo
  } else {
    // $saldo_cor = "text-warning"; amarelo para neutro
  }
} else {
  echo "ID do mês não encontrado.";
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrezoCash</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
      <div class="row">
        <div class="cold-md-12">
          <div class="card-header">
            <h4>Resumo mensal
            <a href="index.php" class="btn btn-outline-primary float-end">Voltar</a>
            </h4>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Total de Entradas</th>  
                    <th scope="col">Total de Saídas</th>
                    <th scope="col">Saldo Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>R$ <?php echo number_format($total_entradas, 2, ',', '.');?></td>
                    <td>R$ <?php echo number_format($total_saidas, 2, ',', '.');?></td>
                    <td class="<?php echo $saldo_cor; ?>">R$ <?php echo number_format($saldo_final, 2, ',', '.'); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>