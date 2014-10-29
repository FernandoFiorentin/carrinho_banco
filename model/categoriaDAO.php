<?php
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

}
?>