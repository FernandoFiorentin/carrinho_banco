<?php

class ItemController {

    private $itemDao;

    public function __construct() {
        include_once '../model/itemDAO.php';
        $this->itemDao = new ItemDAO();
    }

    public function listarItens($idVenda) {
        return $this->itemDao->listar($idVenda);
    }

    public function buscarPorId($idItem, $idVenda) {
        return $this->itemDao->buscarPorId($idItem, $idVenda);
    }

    public function inserirItem(Item $item) {
        return $this->itemDao->inserir($item);
    }

    public function editarItem(Item $item) {
        return $this->itemDao->editar($item);
    }

    public function deletarItem($idItem, $idVenda) {
        return $this->itemDao->deletar($idItem, $idVenda);
    }

}

?>