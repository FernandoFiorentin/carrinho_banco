<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include_once 'conexao.php';
include_once 'venda.php';

class VendaDAO {

    private function converteData($data = null) {
        return implode("-", array_reverse(explode("/", $data)));
    }

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
            $dtAmericana = $this->converteData($vend->getData());
            
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':cliente', $vend->getCliente());
            $stmt->bindValue(':desconto', $vend->getDesconto());
            $stmt->bindValue(':data', $dtAmericana);
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
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
            $dtAmericana = $this->converteData($vend->getData());

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':cliente', $vend->getCliente());
            $stmt->bindValue(':desconto', $vend->getDesconto());
            $stmt->bindValue(':data', $dtAmericana);
            $stmt->bindValue(':idVenda', $vend->getId());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            //echo 'erro ao editar';
        }
    }

    public function listar() {
        try {
            
            $sql = "SELECT idVenda,
                    cliente,
                    desconto,
                    DATE_FORMAT(data,'%d/%m/%Y') data                    
                    FROM venda order by idVenda";
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
            
            $sql = "SELECT idVenda,
                    cliente,
                    desconto,
                    DATE_FORMAT(data,'%d/%m/%Y') data                    
                    FROM venda where idVenda = :idVenda";

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idVenda', $idVenda);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $vend = new Venda($row['idVenda'], $row['cliente'], $row['desconto'], $row['data']);
            return $vend;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($idVenda) {
        try {
            $sql = 'delete from venda where idVenda = :idVenda';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idVenda', $idVenda);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo 'erro ao deletar';
        }
    }

}

?>
