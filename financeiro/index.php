<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM meses";
$meses = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Meses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="bi bi-calendar-plus"></i> Cadastro de Meses
                            <a href="despesa-create.php" class="btn btn-outline-primary float-end">Adicionar Categoria</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes.php" method="POST">
                            <div class="mb-3">
                                <label for="txtMeses">Mês</label>
                                <select name="txtMeses" class="form-select" aria-label="Default select example">
                                    <option selected>Selecione o Mês</option>
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Fevereiro">Fevereiro</option>
                                    <option value="Março">Março</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Maio">Maio</option>
                                    <option value="Junho">Junho</option>
                                    <option value="Julho">Julho</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Setembro">Setembro</option>
                                    <option value="Outubro">Outubro</option>
                                    <option value="Novembro">Novembro</option>
                                    <option value="Dezembro">Dezembro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="txtAno">Ano</label>
                                <input type="text" name="txtAno" id="txtAno"  class="form-control" required>
                            </div>
                                <button type="submit" name="create_mes" class="btn btn-outline-primary float-end">Adicionar Mês</button>
                            <div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <div>
                            <h4>Meses Cadastrados</h4>
                        </div>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mês</th>
                                <th>Ano</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($meses as $mes): ?>
                                <tr>
                                    <td><?php echo $mes['id_mes']; ?></td>
                                    <td><?php echo $mes['nome_mes']; ?></td>
                                    <td><?php echo $mes['ano']; ?></td>
                                    <td>
                                        <a href="move-create.php?id_mes=<?=$mes['id_mes']?>" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i> Adicionar Movimentações</a>

                                        <a href="resumo-m.php" class="btn btn-dark btn-sm">Resumo</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>