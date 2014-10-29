<?php
session_start();

include_once 'categoria_controller.php';
include_once '../model/categoria.php';

$catController = new CategoriaController();
if(isset($_GET['excluir']) and $_GET['excluir'] > 0)
{ //exclui

	$catController->excluirCategoria($_GET['excluir']);	
}
else
{  //adiciona
	$cat = new Categoria($_POST['id'],
						 $_POST['nome'],
						 $_POST['descricao'],
						 $_POST['ativo']);


	$catController->adicionarCategoria($cat);
}

header('location: ../view/cadcategoria.php');


?>