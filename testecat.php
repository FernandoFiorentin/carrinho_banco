<?php
include_once 'model/categoriaDAO';
include_once 'model/categoria';

$cat = new Categoria();
$cat->setNome('Teste');
$cat->setDescricao('Descricao Teste');
$cat->setAtivo(1);

$catDao = new CategoriaDAO();
$catDao->insert($cat);
echo 'inserido';
?>