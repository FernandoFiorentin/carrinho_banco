<?php

class CategoriaController {

    /*public function iniciaSessao() {
        if (!isset($_SESSION['Categorias'])) {
            $categorias = array(new Categoria(1, 'Livros', 'Livros de todos os tipos'),
                new Categoria(2, 'Jogos', 'Jogos de todos os tipos'),
                new Categoria(3, 'Filmes', 'Filmes de todos os tipos')
            );
            $_SESSION['Categorias'] = serialize($categorias);
        }
    }*/
    function __construct() {
        include_once '../model/categoriaDAO.php';
    }

    public function listarCategorias() {        
            $catDao = new CategoriaDAO();
            return $catDao->listar();         
    }

    public function getById($id) {
        $catDao = new CategoriaDAO();
        return $catDao->buscarPorId($id);         
    }

    public function inserirCategoria(Categoria $cat) {
        $catDao = new CategoriaDAO();
        return $catDao->inserir($cat);                 
    }

    public function editarCategoria(Categoria $cat) {
        $catDao = new CategoriaDAO();
        return $catDao->editar($cat);                 
    }
    
    public function excluirCategoria($id) {
       $catDao = new CategoriaDAO();
       return $catDao->deletar();         
    }

}

?>