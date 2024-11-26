<?php
$host = 'localhost';
$financeiro = 'root';
$senha = '';
$banco = 'financeiro';

$conn = mysqli_connect($host, $financeiro, $senha, $banco);

if (!$conn){
    die("Erro na conexão: " . mysqli_connect_error());
}

?>