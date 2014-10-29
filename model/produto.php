<?php
include_once 'Categoria.php';

class Produto
{
	private $id;
	private $codigo;
	private $categoria;	
	private $nome;
	private $descricao;
	private $valor;
	private $unidade;
	private $quantidade;
	private $ativo;
	
	public function __construct($id = 0, $cod = '', Categoria $cat = null, $nome = '', $desc = '', $valor = 0, $un = '', $qtde = 0, $ativo = true)
	{
		$this->id = $id;
		$this->codigo = $cod;
		$this->categoria = $cat;	
		$this->nome = $nome;
		$this->descricao = $desc;
		$this->valor = $valor;
		$this->unidade = $un;
		$this->quantidade = $qtde;
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

	public function getCodigo()
	{
		return $this->codigo;
	}
	public function setCodigo($value)
	{
		$this->codigo = $value;
	}

	public function getCategoria()
	{
		return $this->categoria;
	}
	public function setCategoria(Categoria $value)
	{
		$this->categoria = $value;
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
	
	public function getValor()
	{
		return $this->valor;
	}
	public function setValor($value)
	{
		$this->valor = $value;
	}

	public function getUnidade()
	{
		return $this->unidade;
	}
	public function setUnidade($value)
	{
		$this->unidade = $value;
	}

	public function getQuantidade()
	{
		return $this->quantidade;
	}
	public function setQuantidade($value)
	{
		$this->quantidade = $value;
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