<?php

class VendaController {

    private $vendaDao;
    
    public function __construct() {
        include_once '../model/vendaDAO.php';
        $this->vendaDao = new VendaDAO();
    }
   
    public function listarVendas() {
       return $this->vendaDao->listar();
    }

    public function buscarPorId($idVenda) {
        return $this->vendaDao->buscarPorId($idVenda);
    }

    public function inserirVenda(Venda $vend) {
        return $this->vendaDao->inserir($vend);
    }

    public function editarVenda(Venda $vend) {
        return $this->vendaDao->editar($vend);
    }
    
    public function excluirVenda($idVenda) {
        return $this->vendaDao->deletar($idVenda);
    }

}

?>