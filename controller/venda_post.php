<?php
session_start();

include_once 'venda_controller.php';
include_once '../model/venda.php';

$vendController = new VendaController();

if(isset($_GET['excluir']) and $_GET['excluir'] > 0)
{ //exclui
	$vendController->excluirVenda($_GET['excluir']);	
}
else
{  //adiciona
	$vend = new Venda($_POST['id'],
					  $_POST['cliente'],
					  $_POST['desconto'],
					  $_POST['data']);


	$vendController->adicionarVenda($vend);
}

header('location: ../view/cadvendas.php');


?>