<?php

class Categoria
{
	private $id;
	private $nome;
	private $descricao;
	private $ativo;
	
		
	public function __construct($id = 0, $nome = '', $desc = '', $ativo = true)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $desc;
		$this->ativo = $ativo;
	}
	
	public function getId()
	{
		return $this->id;
	}
	public function setId($value)
	{
		$this->id = $value;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	public function setNome($value)
	{
		$this->nome = $value;
	}
	
	public function getDescricao()
	{
		return $this->descricao;
	}
	public function setDescricao($value)
	{
		$this->descricao = $value;
	}
	
	public function getAtivo()
	{
		return $this->ativo;
	}
	public function setAtivo($value)
	{
		$this->ativo = $value;
	}
}
?>