<?php
if (isset($_POST['create_mes'])) {
    $nome_mes = mysqli_real_escape_string($conn, $_POST['txtNomeMes']);
    $ano = mysqli_real_escape_string($conn, $_POST['txtAno']);

    if(empty($nome_mes) || empty($ano)) {
        $_SESSION['type'] = 'error';
        $_SESSION['message'] = 'Campos de mês e ano são obrigatórios!';
    } else {
        $sql = "INSERT INTO meses (nome_mes, ano) VALUES ('$nome_mes', '$ano')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Mês criado com sucesso!';
        } else {
            $_SESSION['type'] = 'error';
            $_SESSION['message'] = 'Erro ao criar mês.';
        }
    }
}

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

if (isset($_POST['create_move'])) {
    $data = mysqli_real_escape_string($conn, $_POST['txtDataTransaçao']);
    $tipo = mysqli_real_escape_string($conn, $_POST['txtTipo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $valor = mysqli_real_escape_string($conn, $_POST['txtValor']);
    $categoria = mysqli_real_escape_string($conn, $_POST['txtCategoria']);

    if(empty($data) || empty($tipo)  || empty($descricao) || empty($valor)) {
        $_SESSION['type'] = 'error';
        $_SESSION['message'] = 'Preencha todos os campos';
    } else {
         $sql ="INSERT INTO movimentacao (data_transacao, tipo, descricao, valor, id_categoria) 
         VALUES ('$data', '$tipo', '$descricao', '$valor', '$categoria')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Movimentação registrada com sucesso!';
        } else {
            $_SESSION['type'] = 'error';
            $_SESSION['message'] = 'Movimentação não foi registrada.';
        }
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
    
} else {
    $_SESSION['type'] = 'error';
    $_SESSION['message'] = 'Mês não encontrado.';
}
?>