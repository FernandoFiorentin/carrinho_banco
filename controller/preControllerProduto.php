<?php

session_start();

include_once 'controllerProduto.php';
include_once 'controllerCategoria.php';
include_once '../model/produto.php';
include_once '../model/categoria.php';

//echo '<pre>';
//print_r($_POST);
//echo '<pre>';

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
}

$prodController = new ProdutoController();
if ($acao == 'excluir') { //exclui
    $prodController->excluirProduto($_GET['idprod']);
} elseif($acao == 'inserir') {    
    $catController = new CategoriaController();
    $prod = new produto($_POST['id'], $_POST['codigo'], $catController->buscarPorId($_POST['categoria']), $_POST['nome'], $_POST['descricao'], $_POST['valor'], $_POST['unidade'], $_POST['quantidade'], $_POST['ativo']);
    $prodController->inserirProduto($prod);
}elseif($acao == 'editar') {    
    $catController = new CategoriaController();
    $prod = new produto($_POST['id'], $_POST['codigo'], $catController->buscarPorId($_POST['categoria']), $_POST['nome'], $_POST['descricao'], $_POST['valor'], $_POST['unidade'], $_POST['quantidade'], $_POST['ativo']);
    $prodController->editarProduto($prod);
}

header('location: ../view/cadproduto.php');
?>
