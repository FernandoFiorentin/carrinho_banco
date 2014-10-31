<?php

class CategoriaController {

    public function iniciaSessao() {
        if (!isset($_SESSION['Categorias'])) {
            $categorias = array(new Categoria(1, 'Livros', 'Livros de todos os tipos'),
                new Categoria(2, 'Jogos', 'Jogos de todos os tipos'),
                new Categoria(3, 'Filmes', 'Filmes de todos os tipos')
            );
            $_SESSION['Categorias'] = serialize($categorias);
        }
    }

    public function listarCategorias() {
        if (isset($_SESSION['Categorias'])) {
            //$catDao = new CategoriaDAO();
            //return $catDao->listar();
            return unserialize($_SESSION['Categorias']);
        } else {
            return array();
        }
    }

    public function getById($id) {
        if (isset($_SESSION['Categorias'])) {
            $categorias = unserialize($_SESSION['Categorias']);
            foreach ($categorias as $cat) {
                if ($cat->getId() == $id) {
                    return $cat;
                }
            }
        }
    }

    public function adicionarCategoria(Categoria $cat) {
        if (isset($_SESSION['Categorias']) and $cat->getId() > 0) {
            $categorias = unserialize($_SESSION['Categorias']);
            for ($i = 0; $i < count($categorias); $i++) {
                if ($categorias[$i]->getId() == $cat->getId()) {
                    $categorias[$i] = $cat;
                    $_SESSION['Categorias'] = serialize($categorias);
                    return true;
                }
            }

            $categorias[] = $cat;
            $_SESSION['Categorias'] = serialize($categorias);
            return true;
        } else {
            return false;
        }
    }

    public function excluirCategoria($id) {
        if (isset($_SESSION['Categorias'])) {
            $categorias = unserialize($_SESSION['Categorias']);
            for ($i = 0; $i < count($categorias); $i++) {
                if ($categorias[$i]->getId() == $id) {
                    unset($categorias[$i]);
                    $_SESSION['Categorias'] = serialize(array_values($categorias));
                    return true;
                }
            }
        }
        return false;
    }

}

?>