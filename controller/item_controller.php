<?php

class ItemController 
{
	public function iniciaSessao($idVenda)
	{
		if(!isset($_SESSION['ItensVenda'.$idVenda]))
		{			
			$_SESSION['ItensVenda'.$idVenda] = serialize(array());
		}
		
	}

	public function listarItens($idVenda)
	{
		if(isset($_SESSION['ItensVenda'.$idVenda]))
		{
			return unserialize($_SESSION['ItensVenda'.$idVenda]);
		}
		else
		{
			return array();
		}
	}

	public function getById($idItem, $idVenda)
	{
		if(isset($_SESSION['ItensVenda'.$idVenda]))
		{
			$itens = unserialize($_SESSION['ItensVenda'.$idVenda]);
			foreach ($itens as $item) {
				if($item->getId() == $idItem)
				{
					return $item;
				}
			}
		}
	}

	public function adicionarItem(Item $item)
	{		
		if(isset($_SESSION['ItensVenda'.$item->getIdVenda()]) and $item->getId() > 0)
		{
			$itens = unserialize($_SESSION['ItensVenda'.$item->getIdVenda()]);
			for($i = 0; $i < count($itens); $i++)
			{
				if($itens[$i]->getId() == $item->getId())
				{
					$itens[$i] = $item;
					$_SESSION['ItensVenda'.$item->getIdVenda()] = serialize($itens);
					return true;		
				}
			}

			$itens[] = $item;
			$_SESSION['ItensVenda'.$item->getIdVenda()] = serialize($itens);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function excluirItem($idItem, $idVenda)
	{
		if(isset($_SESSION['ItensVenda'.$idVenda]))
		{
			$itens = unserialize($_SESSION['ItensVenda'.$idVenda]);
			for($i = 0; $i < count($itens); $i++)
			{
				if($itens[$i]->getId() == $idItem)
				{
					unset($itens[$i]);
					$_SESSION['ItensVenda'.$idVenda] =  serialize(array_values($itens));
					return true;
				}
			}
		}

	}

}
?>