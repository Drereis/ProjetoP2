<?php
session_start();
require_once('conexao.php');

$gastos = [];

if (!isset($_GET['id'])) {
    header('Location: dindex.php');
} else {
    $gastos_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM gastos WHERE id = '{$gastos_id}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query)> 0) {
        $gastos = mysqli_fetch_array($query);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar-Categoria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Categoria
                        <a href="dindex.php" class="btn btn-outline-dark float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $gastos_id = mysqli_real_escape_string($conn, $_GET['id']);
                        $sql = "SELECT * FROM gastos WHERE id='$gastos_id'";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query)> 0) {
                            $gastos = mysqli_fetch_array($query);
                    ?>
                    <form action="acoes.php" method="POST">
                        <input type="hidden" name="gastos_id" value="<?=$gastos['id']?>">
                        <div class="mb-3">
                            <label>Nome da Categoria</label>
                            <input type="text" name="categoria" value="<?=$gastos['categoria']?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="edit_categoria" class="btn btn-outline-dark">Salvar</button>
                        </div>
                    </form>
                    <?php
                    } else {
                        echo "<h5>Tarefa não encontrada</h5>";
                    }  
                }
                ?>
                </div>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>