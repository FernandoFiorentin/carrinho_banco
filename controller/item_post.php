<?php
session_start();

include_once 'item_controller.php';
include_once 'produto_controller.php';
include_once '../model/item.php';
include_once '../model/produto.php';
include_once '../model/venda.php';

$itemController = new ItemController();

if(isset($_GET['excluir']) and $_GET['excluir'] > 0)
{ //exclui

	$itemController->excluirItem($_GET['excluir'], $_GET['vend']);	
	$venda = $_GET['vend'];
}
else
{  	
	$produto = null;
	if($_POST['produto'] > 0)
	{
		$prodController = new ProdutoController();
		$produto = $prodController->getById($_POST['produto']);
	}
	$venda = $_POST['venda'];

	$item = new Item($_POST['id'],
					  $produto,
					  $_POST['venda'],
					  $_POST['quantidade']);
echo '<pre>';
print_r($item);
echo '</pre>';
	//exit;
	$itemController->adicionarItem($item);
}

header('location: ../view/caditens.php?vend='.$venda);


?>