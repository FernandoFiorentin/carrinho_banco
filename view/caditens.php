<?php 
	session_start();
	include_once '../controller/produto_controller.php';
	include_once '../controller/categoria_controller.php';
	include_once '../controller/venda_controller.php';
	include_once '../controller/item_controller.php';
	include_once '../model/produto.php';
	include_once '../model/categoria.php';	
	include_once '../model/venda.php';	
	include_once '../model/item.php';	
?>

<html>
	<head>
		<h3>Itens da Venda</h3>
	</head>
	<body>
		<ul>
		<li><a href="cadvendas.php">Voltar para Venda</a></li>
		</ul>
		<?php
			$itemController = new ItemController();
			if(isset($_GET['vend']))
			{
				$itemController->iniciaSessao($_GET['vend']);
			}
			else
			{
				header('location: cadvendas.php');
			}

			if(isset($_GET['item']))
			{
				$item = $itemController->getById($_GET['item'], $_GET['vend']);				
			}
			else
			{
				$item = new Item('',null,'','');
			}
	
			$vendController = new VendaController();
			$venda = $vendController->getById($_GET['vend']);
			//echo '<pre>';
			//print_r(unserialize($_SESSION['ItensVenda'.$_GET['vend']]));
			//echo '</pre>';
		?>

<!-- Tabela da venda -->
		<table border="1px solid" style="border-collapse: collapse;">			
			<tr>
				<th colspan="4" align="center">Venda</th>
			</tr>
			<tr>				
				<th>ID</th>
				<th>Cliente</th>
				<th>Desconto</th>
				<th>Data</th>
			</tr>
			<?php				
				echo '<tr>';
				echo '<td>'.$venda->getId().'</td>';
				echo '<td>'.$venda->getCliente().'</td>';
				echo '<td>'.$venda->getDesconto().'</td>';
				echo '<td>'.$venda->getData().'</td>';	
			?>
		</table>
		<br>
<!-- Formulario de Inserção dos Itens -->
		<form name="CadItem" method="post" action="../controller/item_post.php">
			<input type="hidden" name="venda" value=<?php echo '"'.$_GET['vend'].'"'?> > 
			ID 		   <input type="text" name="id" value=<?php echo '"'.$item->getId().'"'?> ><br>
			Produto <select name="produto">
						<option value=""></option>
					  <?php
						$prodController = new ProdutoController();
						$produtos = $prodController->listarProdutos();						
					echo '<pre>';
					print_r($produtos);
					echo '</pre>';
						foreach ($produtos as $prod) {						
							if($item->getProduto() != null and $prod->getId() == $item->getProduto()->getId())
							{
								echo '<option value = "'.$prod->getId().'" selected>'.$prod->getNome().'</option>';
							}
							else
							{
								echo '<option value = "'.$prod->getId().'">'.$prod->getNome().'</option>';
							}							
						}
					  ?>
					  </select><br>
			Quantidade <input type="text" name="quantidade" value=<?php echo '"'.$item->getQuantidade().'"'?> ><br>
			<input type="submit" value="Cadastrar">
			<input type="button" value="Excluir" onclick=<?php echo "location.href='../controller/item_post.php?excluir=".$item->getId()."&vend=".$item->getIdVenda()."';"?> >
		</form>

<!-- Tabela de Itens da venda -->
		<table border="1px solid" style="border-collapse: collapse;">			
			<tr>
				<th colspan="6" align="center">Itens da Venda</th>
			</tr>		
			<tr>						
				<th>ID</th>
				<th>Produto</th>
				<th>Quantidade</th>
				<th>Valor</th>
				<th>Total</th>
			</tr>
			<?php
			if(isset($_GET['vend']))
			{
				$itens = $itemController->listarItens($_GET['vend']);
				foreach($itens as $item)
				{
					echo '<tr>';
					echo '<td>'.$item->getId().'</td>';
					echo '<td>'.$item->getProduto()->getNome().'</td>';
					echo '<td>'.$item->getQuantidade().'</td>';
					echo '<td>'.$item->getProduto()->getValor().'</td>';
					echo '<td>'.$item->getValorTotal().'</td>';
					echo '<td width="35px" align="center"><a href="caditens.php?vend='.$item->getIdVenda().'&item='.$item->getId().'"><img src="../img/editar.jpg" title="editar"></a></td>';
					echo '</tr>';					
				}
			}
			?>
		</table>
	</body>
</html>