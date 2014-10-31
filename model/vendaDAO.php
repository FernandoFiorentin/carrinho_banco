<?php

include_once 'conexao.php';
include_once 'venda.php';

class VendaDAO {

    public function inserir(Venda $vend) {
        try {
            $sql = 'INSERT INTO venda
                     (cliente,
                     desconto,
                     data)
                     VALUES
                     (:cliente,
                     :desconto,
                     :data)';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':cliente', $vend->getCliente());
            $stmt->bindValue(':desconto', $vend->getDesconto());
            $stmt->bindValue(':data', $vend->getData());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            //GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());            
        }
    }

    public function editar(Venda $vend) {
        try {
            $sql = 'UPDATE venda
                SET                
                cliente = :cliente,
                desconto = :desconto,
                data = :data                
                WHERE idVenda = :idVenda;';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':cliente', $vend->getCliente());
            $stmt->bindValue(':desconto', $vend->getDesconto());
            $stmt->bindValue(':data', $vend->getData());
            $stmt->bindValue(':idVenda', $vend->getId());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage().'<br>';
            //echo 'erro ao editar';
        }
    }

    public function listar() {
        try {
            $sql = 'SELECT idVenda,
                    cliente,
                    desconto,
                    data                    
                    FROM venda order by idVenda';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            $vendas = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $vend = new Venda($row['idVenda'], $row['cliente'], $row['desconto'], $row['data']);
                $vendas[] = $vend;
            }
            return $vendas;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function buscarPorId($idVenda) {
        try {
            $sql = 'SELECT idVenda,
                    cliente,
                    desconto,
                    data                    
                    FROM venda where idVenda = :idVenda';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idVenda', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $vend = new Venda($row['idVenda'], $row['cliente'], $row['desconto'], $row['data']);
            return $cat;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($idVenda) {
        try {
            $sql = 'delete from venda where idVenda = :idVenda';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idCategoria', $idCategoria);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo 'erro ao deletar';
        }
    }

}

?>