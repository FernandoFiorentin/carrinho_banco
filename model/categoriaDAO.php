<?php

include_once 'conexao.php';
include_once 'categoria.php';

class CategoriaDAO {

    public function inserir(Categoria $cat) {
        Conexao::getInstance()->beginTransaction();
        try {
            $sql = 'INSERT INTO categoria
                     (nome,
                     descricao,
                     ativo)
                     VALUES
                     (:nome,
                     :descricao,
                     :ativo)';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':nome', $cat->getNome());
            $stmt->bindValue(':descricao', $cat->getDescricao());
            $stmt->bindValue(':ativo', $cat->getAtivo());
            $result = $stmt->execute();
            Conexao::getInstance()->commit();
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
            Conexao::getInstance()->rollback();
            //GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());            
        }
    }

    public function editar(Categoria $cat) {
        Conexao::getInstance()->beginTransaction();
        try {
            $sql = 'UPDATE categoria
                SET                
                nome = :nome,
                descricao = :descricao,
                ativo = :ativo                
                WHERE idCategoria = :idCategoria;';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idCategoria', $cat->getId());
            $stmt->bindValue(':nome', $cat->getNome());
            $stmt->bindValue(':descricao', $cat->getDescricao());
            $stmt->bindValue(':ativo', $cat->getAtivo());
            $result = $stmt->execute();
            Conexao::getInstance()->commit();
            return $result;
        } catch (Exception $e) {
            //echo $e->getMessage().'<br>';
            echo 'erro ao editar';
            Conexao::getInstance()->rollback();
        }
    }

    public function listar() {        
        try {
            $sql = 'SELECT idCategoria,
                    nome,
                    descricao,
                    ativo                    
                    FROM categoria order by idCategoria';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            $categorias = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cat = new Categoria($row['idCategoria'], $row['nome'], $row['descricao'], $row['ativo']);
                $categorias[] = $cat;
            }
            return $categorias;
        } catch (Exception $e) {
            echo 'erro ao listar';
        }
    }

    public function buscarPorId($id) {
        
        try {
            $sql = 'SELECT idCategoria,
                    nome,
                    descricao,
                    ativo                    
                    FROM categoria where idCategoria = :idCategoria';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idCategoria', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cat = new Categoria($row['idCategoria'], $row['nome'], $row['descricao'], $row['ativo']);
            return $cat;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($idCategoria) {
        Conexao::getInstance()->beginTransaction();
        try {
            $sql = 'delete from categoria where idCategoria = :idCategoria';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idCategoria', $idCategoria);
            $result = $stmt->execute();
            Conexao::getInstance()->commit();
            return $result;
        } catch (Exception $ex) {
            echo 'erro ao deletar';
            Conexao::getInstance()->rollback();
        }
    }

}

?>