<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM gastos";
$categorias = mysqli_query($conn, $sql);

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentações Financeiras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Cadastro de Movimentação
                            <a href="index.php" class="btn btn-outline-danger float-end">Voltar</a>
                        </h4>
                    </div>
                        <div class= "card-body">
                            <form action="acoes.php" method="POST">
                                <div class="mb-3">
                                    <label for="txtDataTransacao">Data</label>
                                    <input type="date" name="txtDataTransacao" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="txtTipo">Tipo</label>
                                    <select name="txtTipo" class="form-select" aria-label="Default select example">
                                        <option value="Entrada">Entrada</option>    
                                        <option value="Saída">Saída</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtDescricao">Descrição</label>
                                    <input type="text" name="txtDescricao" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="txtValor">Valor</label>
                                    <input type="num" name="txtValor" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="txtCategoria">Categoria</label>
                                    <select name="TxtCategoria" class="form-select" required>
                                        <?php while ($categoria = mysqli_fetch_array($categorias)): ?>
                                            <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" name="create_move" class="btn btn-outline-primary">Registrar Movimentação</button>
                            </form>
                            <?php include('message.php'); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>