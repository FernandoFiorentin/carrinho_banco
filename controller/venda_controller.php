<?php

class VendaController 
{
	public function iniciaSessao()
	{
		if(!isset($_SESSION['Vendas']))
		{			
			$_SESSION['Vendas'] = serialize(array());
		}
		
	}

	public function listarVendas()
	{
		if(isset($_SESSION['Vendas']))
		{
			return unserialize($_SESSION['Vendas']);
		}
		else
		{
			return array();
		}
	}

	public function getById($id)
	{
		if(isset($_SESSION['Vendas']))
		{
			$vendas = unserialize($_SESSION['Vendas']);
			foreach ($vendas as $vend) {
				if($vend->getId() == $id)
				{
					return $vend;
				}
			}
		}
	}

	public function adicionarVenda(Venda $vend)
	{
		if(isset($_SESSION['Vendas']) and $vend->getId() > 0)
		{
			$vendas = unserialize($_SESSION['Vendas']);
			for($i = 0; $i < count($vendas); $i++)
			{
				if($vendas[$i]->getId() == $vend->getId())
				{
					$vendas[$i] = $vend;
					$_SESSION['Vendas'] = serialize($vendas);
					return true;		
				}
			}

			$vendas[] = $vend;
			$_SESSION['Vendas'] = serialize($vendas);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function excluirVenda($id)
	{
		if(isset($_SESSION['Vendas']))
		{
			$vendas = unserialize($_SESSION['Vendas']);
			for($i = 0; $i < count($vendas); $i++)
			{
				if($vendas[$i]->getId() == $id)
				{
					if(isset($_SESSION['ItensVenda'.$id]))
					{
						unset($_SESSION['ItensVenda'.$id]);
					}
					unset($vendas[$i]);
					$_SESSION['Vendas'] = serialize(array_values($vendas));
					return true;
				}
			}
		}

	}

}
?>