<?php

class ProdutoController {

    function __construct() {
        include_once '../model/produtoDAO.php';
    }

    public function listarProdutos() {
        $prodDao = new ProdutoDAO();
        return $prodDao->listar();        
    }

    public function buscarPorId($id) {        
        $prodDao = new ProdutoDAO();
        return $prodDao->buscarPorId($id);                
    }

    public function inserirProduto(Produto $prod) {
        $prodDao = new ProdutoDAO();
        return $prodDao->inserir($prod);
    }
    
     public function editarProduto(Produto $prod) {
        $prodDao = new ProdutoDAO();
        return $prodDao->editar($prod);
    }

    public function excluirProduto($id) {
        $prodDao = new ProdutoDAO();
        return $prodDao->deletar($id);
    }

}

?>