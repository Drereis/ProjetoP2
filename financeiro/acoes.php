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
    $id_mes = mysqli_real_escape_string($conn, $_POST['id_mes']);
    $data = mysqli_real_escape_string($conn, $_POST['txtDataTransacao']);
    $tipo = mysqli_real_escape_string($conn, $_POST['txtTipo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $valor = mysqli_real_escape_string($conn, $_POST['txtValor']);
    $categorias = mysqli_real_escape_string($conn, $_POST['txtCategoria']);

    $sql ="INSERT INTO movimentacao (data_transacao, tipo, descricao, valor, id_categoria, id_mes) 
    VALUES ('$data', '$tipo', '$descricao', '$valor', '$categorias',  '$id_mes')";

    mysqli_query($conn, $sql);

    header('Location: move-create.php?$id_mes' . $id_mes);
    exit();
}

if (isset($_POST['delete_mes'])) {
    $mesId = mysqli_real_escape_string($conn, $_POST['delete_mes']);
    $sql = "DELETE FROM meses WHERE id_mes = '$mesId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Mês com ID {$mesId} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir o mês";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
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



?>