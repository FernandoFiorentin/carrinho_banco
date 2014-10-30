<?php
//Somente para inicializar a session 
//do cadastro de Produtos e Categorias
session_start();
include_once 'controller/produto_controller.php';
include_once 'model/produto.php';
include_once 'controller/categoria_controller.php';
include_once 'model/categoria.php';
include_once 'controller/venda_controller.php';
include_once 'model/venda.php';
$catController = new CategoriaController();
$catController->iniciaSessao();
$prodController = new ProdutoController();
$prodController->iniciaSessao();
$vendController = new VendaController();
$vendController->iniciaSessao();
?>
<html>
    <head>
    <h2>Carrinho de Compras</h2>
</head>
<body>
    <ul>
        <li><a href="view/cadcategoria.php">Cadastro de Categoria</a></li>
        <li><a href="view/cadproduto.php">Cadastro de Produto</a></li>
        <li><a href="view/cadvendas.php">Vendas</a></li>
    </ul>
</body>
</html>