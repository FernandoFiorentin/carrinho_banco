<?php

class Venda {

    private $id;
    private $cliente;
    private $desconto;
    private $data;

    public function __construct($id = 0, $cliente = '', $desc = 0, $data = '') {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->desconto = $desc;
        $this->data = $data;
    }

    public function getValorTotal() {
        include_once '../controller/controllerItem.php';
        include_once 'item.php';

        $itemController = new ItemController();
        $itens = $itemController->listarItens($this->id);
        $total = 0;
        if ($itens) {
            foreach ($itens as $item) {
                $total += $item->getValorTotal();
            }
        } else {
            $total = 0;
        }

        $total -= $this->desconto;
        return $total;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($value) {
        $this->cliente = $value;
    }

    public function getDesconto() {
        return $this->desconto;
    }

    public function setDesconto($value) {
        $this->desconto = $value;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($value) {
        $this->data = $value;
    }

}

?>