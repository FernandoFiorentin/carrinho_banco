<?php
session_start();

include_once 'produto_controller.php';
include_once 'categoria_controller.php';
include_once '../model/produto.php';
include_once '../model/categoria.php';

$prodController = new ProdutoController();
if(isset($_GET['excluir']) and $_GET['excluir'] > 0)
{ //exclui

	$prodController->excluirProduto($_GET['excluir']);	
}
else
{  //adiciona
	//__construct($id = 0, $cod = '', Categoria $cat = null, $nome = '', $desc = '', $valor = 0, $un = '', $qtde = 0, $ativo = true)
	$catController = new CategoriaController();

	$prod = new produto($_POST['id'],
						$_POST['codigo'],
						$catController->getById($_POST['categoria']),
						$_POST['nome'],
						$_POST['descricao'],
						$_POST['valor'],
						$_POST['unidade'],
						$_POST['quantidade'],
						$_POST['ativo']);

	$prodController->adicionarProduto($prod);
}

header('location: ../view/cadproduto.php');


?>
