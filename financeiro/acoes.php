<?php
session_start();
require_once('conexao.php');


// ações mês

if (isset($_POST['create_mes'])) {
    $mes = trim($_POST['txtMeses']);
    $ano = trim($_POST['txtAno']);

    $sql ="INSERT INTO meses (nome_mes, ano) VALUES ('$mes', '$ano')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['create_move'])) {
    $data = mysqli_real_escape_string($conn, $_POST['txtDataTransacao']);
    $tipo = mysqli_real_escape_string($conn, $_POST['txtTipo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $valor = mysqli_real_escape_string($conn, $_POST['txtValor']);
    $categorias = mysqli_real_escape_string($conn, $_POST['txtCategoria']);
   

    $sql ="INSERT INTO movimentacao (data_transacao, tipo, descricao, valor, id) 
    VALUES ('$data', '$tipo', '$descricao', '$valor', '$categorias')";

    mysqli_query($conn, $sql);

    header('Location: move-create.php');
    exit();
}

// ações gastos

if(isset($_POST['create_categoria'])) {
    $categoria = trim($_POST['txtCategoria']);

    $sql = "INSERT INTO gastos (categoria) VALUES ('$categoria')";

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)> 0) {
        $_SESSION['message'] = "Categoria {$categoria} criada com sucesso";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "OPS!!! Não foi possivel criar a Categoria.";
        $_SESSION['type'] = 'error';
    }

    header('Location: despesa-create.php');
    exit;

}
// bloco para editar a categoria
if (isset($_POST['edit_categoria'])) {
    $gastos_id =  mysqli_real_escape_string($conn, $_POST['gastos_id']);    
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

    $sql = "UPDATE gastos SET categoria = '{$categoria}'";

    $sql .= " WHERE id = '{$gastos_id}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn)> 0) {
        $_SESSION['mensagem'] = 'Categoria atualizada com sucesso';
        header('Location:dindex.php');
        exit;
     } else {
        $_SESSION['mensagem'] = 'Categoria não foi atualizada';
        header('Location:dindex.php');
        exit;
     } 
}
    
  


// bloco para deletar a categoria 
if (isset($_POST['delete_categoria'])) {
    $gastos_id = mysqli_real_escape_string($conn, $_POST['delete_categoria']);
    $sql = "DELETE FROM gastos WHERE id = '$gastos_id'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0){
        $_SESSION['mensagem'] = 'Categoria deletada com sucesso';
        header('Location: dindex.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Categoria não foi deletada';
        header('Location: dindex.php');
        exit;   
    }

}

if (isset($_GET['mes'])) {
    $id_mes = $_GET['mes'];

    $sql_entradas = "SELECT SUM (valor) AS total_entradas FROM movimentacao WHERE tipo = 'entrada' AND id_mes = '$id_mes'";
    $sql_saidas = "SELECT SUM (valor) AS total_saidas FROM movimentacao WHERE tipo = 'saida' AND id_mes = '$id_mes'";

    $result_entradas = mysqli_query($conn, $sql_entradas);
    $result_saidas = mysqli_fetch_assoc($result_saidas);

    $total_entradas = mysqli_fetch_assoc($result_entradas)['total_entradas'];
    $total_saidas = mysqli_fetch_assoc($result_saidas)['total_saidas'];

    $saldo_final = $total_entradas - $total_saidas;
    $saldo_cor = $saldo_final < 0 ? 'text danger' : ($saldo_final == 0 ? 'text-warning' : 'text_sucess');

}

?>