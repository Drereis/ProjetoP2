<?php
session_start();
require_once("conexao.php");

if (isset($_POST['create_categoria'])) {
    $cateogoria = mysqli_real_escape_string($conn, $_POST['txtCategoria']);
    
    if(empty($categoria)) {
        $_SESSION['type'] = 'error';
        $_SESSION['message'] = 'O campo "Nome da Categoria" não pode ser vazio!';
    } else {
        $sql = "INSERT INTO gastos (categoria) VALUES ('$categoria')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Categoria criado com sucesso!';
        } else {
            $_SESSION['type'] = 'error';
            $_SESSION['message'] = 'Erro ao criar categoria.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<!-- Criar categoria de despesa  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar - Despesa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-file-earmark-plus"></i> Criar categoria
                        <a href="index.php" class="btn btn-outline-primary float-end">Voltar</a>
                    </h4>
                </div>
                <!-- Coluna para adicionar a categoria a lista de categorias -->
                <?php include ('message.php'); ?>
                <div class="card-body">
                    <form action="acoes.php" method="POST">
                        <div class="mb-3">
                            <label for="txtCategoria">Nome da Categoria</label>
                            <input type="text" name="txtCategoria" class="form-control" required>
                        </div>
                        <div>
                            <button type="submit" name="create_categoria" class="btn btn-outline-primary">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>