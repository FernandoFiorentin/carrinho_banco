<?php


class ProdutoController
{
	public function iniciaSessao()
	{
		if(!isset($_SESSION['Produtos']))
		{						
			$produtos = array(new Produto(1, '001', new Categoria(2,'Jogos','Jogos de todos os tipos'), 'Bioshock', 'Jogo Bioshock', 100, 'UN', 1, true),
							  new Produto(2, '002', new Categoria(1,'Livros','Livros de todos os tipos'), 'Tropas Estelares', 'Livro de ficção', 15, 'UN', 1, true),
							  new Produto(3, '003', new Categoria(3,'Filmes','Filmes de todos os tipos'), 'Her', 'Filme bom', 10, 'UN', 3, true)
							  );
			$_SESSION['Produtos'] = serialize($produtos);
		}
	}

	public function listarProdutos()
	{
		if(isset($_SESSION['Produtos']))
		{
			return unserialize($_SESSION['Produtos']);
		}
		else
		{
			return array();
		}
	}

	public function getById($id)
	{
		if(isset($_SESSION['Produtos']))
		{
			$produtos = unserialize($_SESSION['Produtos']);
			foreach ($produtos as $prod) {
				if($prod->getId() == $id)
				{
					return $prod;
				}
			}
		}
	}

	public function adicionarProduto(Produto $prod)
	{
		if(isset($_SESSION['Produtos']) and $prod->getId() > 0)
		{
			$produtos = unserialize($_SESSION['Produtos']);
			for($i = 0; $i < count($produtos); $i++)
			{
				if($produtos[$i]->getId() == $prod->getId())
				{
					$produtos[$i] = $prod;
					$_SESSION['Produtos'] = serialize($produtos);
					return true;		
				}
			}

			$produtos[] = $prod;
			$_SESSION['Produtos'] = serialize($produtos);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function excluirProduto($id)
	{
		if(isset($_SESSION['Produtos']))
		{
			$produtos = unserialize($_SESSION['Produtos']);
			for($i = 0; $i < count($produtos); $i++)
			{
				if($produtos[$i]->getId() == $id)
				{
					unset($produtos[$i]);
					$_SESSION['Produtos'] = serialize(array_values($produtos));
					return true;
				}
			}
		}

	}
	
}
?>