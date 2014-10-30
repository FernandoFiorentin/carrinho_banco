<?php

include_once 'conexao.php';
include_once 'produto.php';

class CategoriaDAO {

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
            $stmt->bindValue(':idCategoria', $prod->getCategoria()->getCodigo());
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
            $stmt->bindValue(':idCategoria', $prod->getCategoria()->getCodigo());
            $stmt->bindValue(':nome', $prod->getNome());
            $stmt->bindValue(':descricao', $prod->getDescricao());
            $stmt->bindValue(':valor', $prod->getValor());
            $stmt->bindValue(':unidade', $prod->getUnidade());
            $stmt->bindValue(':quantidade', $prod->getQuantidade());
            $stmt->bindValue(':ativo', $prod->getAtivo());
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage().'<br>';            
        }
    }

    public function listar() {
        /*try {
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
                $cat = new Categoria($row['idCategoria'], $row['nome'], $row['descricao'], $row['ativo']);
                $produtos[] = $cat;
            }
            return $categorias;
        } catch (Exception $e) {
            echo 'erro ao listar';
        }*/
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

/*

  calss CategoriaDAO
  {
  function __construct()
  {
  include_once 'abreConexao.php';
  include_once 'categoria.php'
  }

  public function insert(Categoria $categoria)
  {
  $stmt = $con->prepare(
  'insert into categoria(nome, descricao, ativo) values(:nome, :descricao, :ativo)';
  );

  $stmt->bindValue(':nome',$categoria->getNome());
  $stmt->bindValue(':descricao',$categoria->getDescricao());
  $stmt->bindValue(':ativo',$categoria->getAtivo());

  $stmt->execute();
  $stmt->commit();
  }

  } */
?>