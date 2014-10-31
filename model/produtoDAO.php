<?php

include_once 'conexao.php';
include_once 'produto.php';
include_once 'categoriaDAO.php';

class ProdutoDAO {

    public function inserir(Produto $prod) {
        try {
            $sql = 'insert into produto 
                    (idProduto,
                    codigo,
                    idCategoria,
                    nome,
                    descricao,
                    valor,
                    unidade,
                    quantidade,
                    ativo)
                    values
                    (:idProduto,
                    :codigo,
                    :idCategoria,
                    :nome,
                    :descricao,
                    :valor,
                    :unidade,
                    :quantidade,
                    :ativo)';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto', $prod->getId());
            $stmt->bindValue(':codigo', $prod->getCodigo());
            $stmt->bindValue(':idCategoria', $prod->getCategoria()->getId());
            $stmt->bindValue(':nome', $prod->getNome());
            $stmt->bindValue(':descricao', $prod->getDescricao());
            $stmt->bindValue(':valor', $prod->getValor());
            $stmt->bindValue(':unidade', $prod->getUnidade());
            $stmt->bindValue(':quantidade', $prod->getQuantidade());
            $stmt->bindValue(':ativo', $prod->getAtivo());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            //GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());            
        }
    }

    public function editar(Produto $prod) {
        try {
            $sql = 'UPDATE produto
                    SET                                    
                    codigo = :codigo,
                    idCategoria = :idCategoria,
                    nome = :nome,
                    descricao = :descricao,
                    valor = :valor,
                    unidade = :unidade,
                    quantidade = :quantidade,
                    ativo = :ativo                
                    WHERE idProduto = :idProduto;';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto', $prod->getId());
            $stmt->bindValue(':codigo', $prod->getCodigo());
            $stmt->bindValue(':idCategoria', $prod->getCategoria()->getId());
            $stmt->bindValue(':nome', $prod->getNome());
            $stmt->bindValue(':descricao', $prod->getDescricao());
            $stmt->bindValue(':valor', $prod->getValor());
            $stmt->bindValue(':unidade', $prod->getUnidade());
            $stmt->bindValue(':quantidade', $prod->getQuantidade());
            $stmt->bindValue(':ativo', $prod->getAtivo());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
        }
    }

    public function listar() {
        try {
            $sql = 'SELECT idProduto,
                            Codigo,
                            idCategoria,
                            nome,
                            descricao,
                            valor,
                            unidade,
                            quantidade,
                            ativo
                        FROM produto order by idProduto';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->execute();
            $produtos = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $prod = new Produto();
                $prod->setId($row['idProduto']);
                $prod->setCodigo($row['Codigo']);
                $prod->setNome($row['nome']);
                $prod->setDescricao($row['descricao']);
                $prod->setValor($row['valor']);
                $prod->setUnidade($row['unidade']);
                $prod->setQuantidade($row['quantidade']);
                $prod->setAtivo($row['ativo']);
                $catDao = new CategoriaDAO();
                $prod->setCategoria($catDao->buscarPorId($row['idCategoria']));
                $produtos[] = $prod;
            }
            return $produtos;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function buscarPorId($idProduto) {
        try {
            $sql = 'SELECT idProduto,
                            Codigo,
                            idCategoria,
                            nome,
                            descricao,
                            valor,
                            unidade,
                            quantidade,
                            ativo
                        FROM produto where idProduto = :idProduto';

            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto',$idProduto);
            $stmt->execute();
            $prod = new Produto();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<pre>';
            print_r($row);
            echo '</pre>';
            //exit();
            $prod->setId($row['idProduto']);
            $prod->setCodigo($row['Codigo']);
            $prod->setNome($row['nome']);
            $prod->setDescricao($row['descricao']);
            $prod->setValor($row['valor']);
            $prod->setUnidade($row['unidade']);
            $prod->setQuantidade($row['quantidade']);
            $prod->setAtivo($row['ativo']);
            $catDao = new CategoriaDAO();
            $prod->setCategoria($catDao->buscarPorId($row['idCategoria']));

            return $prod;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deletar($idProduto) {
        try {
            $sql = 'delete from produto where idProduto = :idProduto';
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindValue(':idProduto', $idProduto);
            return $stmt->execute();
        } catch (Exception $ex) {
            echo 'erro ao deletar';
        }
    }

}

?>