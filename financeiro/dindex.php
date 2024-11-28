<!-- conexão do index com o banco de dados -->
<?php
session_start();
require_once('conexao.php');

$sql = "SELECT * FROM gastos";
$financeiro = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas despesas</title>
    <!-- Links para o bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('dnavbar.php');?>
    <div class="container mt-4">
        <!-- <?php include ('message.php'); ?> -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Categorias de despesas
                   <a href="index.php" class="btn btn-outline-primary float-end">Voltar</a>
                   </h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                        </tr>
                    </thead>
                       <tbody>
                        <?php
                        $sql = 'SELECT * FROM gastos';
                        $gastos = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($gastos)> 0) {
                            foreach($gastos as $gastos) {
                        ?>
                        <tr>    
                            <td><?=$gastos['id']?></td>
                            <td><?=$gastos['categoria']?></td>
                            <td>
                                <!-- Ações dentro da tabela -->
                                <a href="despesa-edit.php?id=<?=$gastos['id']?>" class="btn btn-dark btn-sm">Editar</a>
                                <form action="acoes.php" method="POST" class="d-inline">
                                    <button onclick="return confirm('Tem certeza que deseja excluir')"type="submit" name="delete_categoria" value="<?=$gastos['id']?>" class="btn btn-danger btn-sm">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                    } else {
                        echo '<h5>Nenhuma categoria encontrada<h5>';
                    }
                    ?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
