<?php

session_start();

include_once './controllerItem.php';
include_once './controllerProduto.php';
include_once '../model/item.php';
include_once '../model/produto.php';
include_once '../model/venda.php';

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
}

$itemController = new ItemController();

if ($acao == 'excluir') { //exclui
    $itemController->deletarItem($_GET['item'], $_GET['vend']);
    $venda = $_GET['vend'];
} elseif($acao == 'inserir') {
    $produto = null;
    if ($_POST['produto'] > 0) {
        $prodController = new ProdutoController();
        $produto = $prodController->buscarPorId($_POST['produto']);
    }
    $venda = $_POST['venda'];

    $item = new Item($_POST['id'], $produto, $_POST['venda'], $_POST['quantidade']);
    $itemController->inserirItem($item);
}elseif($acao == 'editar') {
    $produto = null;
    if ($_POST['produto'] > 0) {
        $prodController = new ProdutoController();
        $produto = $prodController->buscarPorId($_POST['produto']);
    }
    $venda = $_POST['venda'];

    $item = new Item($_POST['id'], $produto, $_POST['venda'], $_POST['quantidade']);
    $itemController->editarItem($item);
}

header('location: ../view/caditens.php?vend=' . $venda);
?>