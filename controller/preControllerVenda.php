<?php
session_start();

include_once 'controllerVenda.php';
include_once '../model/venda.php';

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
}

$vendController = new VendaController();
if($acao == 'excluir'){ 
	$vendController->excluirVenda($_GET['idvenda']);	
}
elseif($acao == 'inserir'){  //adiciona
	$vend = new Venda($_POST['id'],
					  $_POST['cliente'],
					  $_POST['desconto'],
					  $_POST['data']);

	$vendController->inserirVenda($vend);
}elseif($acao == 'editar'){  //adiciona
	$vend = new Venda($_POST['id'],
					  $_POST['cliente'],
					  $_POST['desconto'],
					  $_POST['data']);

	$vendController->editarVenda($vend);
}

header('location: ../view/cadvendas.php');


?>
