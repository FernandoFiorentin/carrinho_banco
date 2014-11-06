<?php
include_once 'produto.php';

class Item
{
	private $id;
	private $produto;
	private $idVenda;
	private $quantidade;
	
	public function __construct($id = 0, Produto $prod = null, $idVenda = '', $quantidade = 0)
	{
		$this->id = $id;
		$this->produto = $prod;
		$this->idVenda = $idVenda;
		$this->quantidade = $quantidade;
	}
	
	public function getValorTotal()
	{
		$prod = $this->produto;
		return ($this->quantidade * $prod->getValor());
	}
	
	public function getId()
	{
		return $this->id;
	}
	public function setId($value)
	{
		$this->id = $value;
	}
	
	public function getProduto()
	{
		return $this->produto;
	}
	public function setProduto($value)
	{
		$this->produto = $value;
	}
	
	public function getIdVenda()
	{
		return $this->idVenda;
	}
	public function setIdVenda($value)
	{
		$this->idVenda = $value;
	}
	
	public function getQuantidade()
	{
		return $this->quantidade;
	}
	public function setQuantidade($value)
	{
		$this->Quantidade = $value;
	}
}
?>