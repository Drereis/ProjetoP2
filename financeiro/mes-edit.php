<?php
session_start();
require_once('conexao.php');

$mes = [];

if (!isset($_GET['id_mes'])) {
    header('Location: index.php');
} else {
    $id_mes = mysqli_real_escape_string($conn, $_GET['id_mes']);
    $sql = "SELECT * FROM meses WHERE id_mes = '{$id_mes}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query)> 0) {
        $mes = mysqli_fetch_array($query);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mês</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Mês
                        <a href="index.php" class="btn btn-outline-dark float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if ($mes) :
                    ?>
                    <form action="acoes.php" method="POST">
                            <input type="hidden" name="id_mes" value="<?$id_mes; ?>">
                            <div class="mb-3">
                                <label for="txtDataTransacao">Data</label>
                                <input type="date" name="txtDataTransacao" value="<?=$mes['data_transacao']?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="txtTipo">Tipo</label>
                                <select name="txtTipo"  value="<?=$mes['tipo']?>" class="form-select" aria-label="Default select example">
                                    <option value="Entrada">Entrada</option>    
                                    <option value="Saída">Saída</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="txtDescricao">Descrição</label>
                                <input type="text" name="txtDescricao" value="<?=$mes['descricao']?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="txtValor">Valor</label>
                                <input type="num" name="txtValor" value="<?=$mes['valor']?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="txtCategoria">Categoria</label>
                                <select name="txtCategoria" id="txtCategoria" value="<?=$mes['id_categoria']?>" class="form-select" required>
                                    <?php while ($categoria = mysqli_fetch_array($categorias)): ?>
                                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <button type="submit" name="edit_mes" class="btn btn-outline-dark">Registrar Movimentação</button>
                    </form>
                    <?php
                    else:
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Mês não encontrado
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <?php
                    endif;
                    ?>
                </div>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>