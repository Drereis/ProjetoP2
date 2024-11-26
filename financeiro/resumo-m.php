<?php
session_start();
require_once("conexao.php");

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
            <a href="index.php" class="btn btn-outline-primary float-end">Adicionar Mês</a>
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