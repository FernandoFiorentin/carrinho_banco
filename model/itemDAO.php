<?php

include_once 'conexao.php';
include_once 'item.php';
include_once 'produtoDAO.php';

class ItemDAO {

    public function inserir(Item $item) {
        try {
            $sql = 'INSERT INTO item
                     (idProduto,
                     idVenda,
                     quantidade)
                     VALUES
                     (:idProduto,
                     :idVenda,
                     :quantidade)';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto', $item->getProduto()->getId());
            $stmt->bindValue(':idVenda', $item->getIdVenda());
            $stmt->bindValue(':quantidade', $item->getQuantidade());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            //GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());            
        }
    }

    public function editar(Item $item) {
        try {
            $sql = 'UPDATE item
                SET                
                idProduto = :idProduto,
                idVenda = :idVenda,
                quantidade = :quantidade                
                WHERE idItem = :idItem;';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto', $item->getProduto()->getId());
            $stmt->bindValue(':idVenda', $item->getIdVenda());
            $stmt->bindValue(':quantidade', $item->getQuantidade());
            $stmt->bindValue(':idItem', $item->getId());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            //echo 'erro ao editar';
        }
    }

    public function listar($idVenda) {
        try {
            $sql = 'SELECT idItem,
                    idProduto,
                    idVenda,
                    quantidade                    
                    FROM item 
                    where idVenda = :idVenda
                    order by idItem';
            
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idVenda',$idVenda);
            $stmt->execute();
            $itens = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $prodDao = new ProdutoDAO();
                $prod = $prodDao->buscarPorId($row['idProduto']);
                $item = new Item($row['idItem'], $prod, $row['idVenda'], $row['quantidade']);
                $itens[] = $item;
            }
            return $itens;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function buscarPorId($idItem) {
        try {
            $sql = 'SELECT idItem,
                    idProduto,
                    idVenda,
                    quantidade                    
                    FROM item order by idItem';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $prodDao = new ProdutoDAO();
            $prod = $prodDao->buscarPorId($row['idProduto']);
            $item = new Item($row['idItem'], $prod, $row['idVenda'], $row['quantidade']);

            return $item;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($idItem) {
        try {
            $sql = 'delete from item where idItem = :idItem';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idItem', $idItem);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo 'erro ao deletar';
        }
    }

}

?>