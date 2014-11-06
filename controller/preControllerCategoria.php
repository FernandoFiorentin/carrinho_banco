<?php

session_start();

include_once 'controllerCategoria.php';
include_once '../model/categoria.php';

echo '<pre>';
print_r($_POST);
echo '<pre>';
exit();

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
}

$catController = new CategoriaController();
if ($acao == 'excluir') {
    $catController->excluirCategoria($_GET['excluir']);
} else {  //adiciona
    $cat = new Categoria($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['ativo']);


    $catController->adicionarCategoria($cat);
}

header('location: ../view/cadcategoria.php');
?>