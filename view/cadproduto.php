<?php 
	session_start();
	include_once '../controller/produto_controller.php';
	include_once '../controller/categoria_controller.php';
	include_once '../model/produto.php';
	include_once '../model/categoria.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<a href="../index.php">Voltar para Menu</a>
		<h2>Cadastro de Produtos</h2>
	</head>
	<body>
		
		<?php
			$prodController = new ProdutoController();

			if(isset($_GET['prod']))
			{
				$produto = $prodController->getById($_GET['prod']);				
			}
			else
			{
				$produto = new Produto('', '', new Categoria('','','',''), '', '', '', '', '');
			}
	
		?>	

		<form name="CadProduto" method="post" action="../controller/produto_post.php">
			ID        <input type="text" name="id" value=<?php echo '"'.$produto->getId().'"'?> ><br>
			Código    <input type="text" name="codigo" value=<?php echo '"'.$produto->getCodigo().'"'?> ><br>
			Nome 	  <input type="text" name="nome" value=<?php echo '"'.$produto->getNome().'"'?> ><br>
			Descricao <input type="text" name="descricao" value=<?php echo '"'.$produto->getDescricao().'"'?> ><br>
			Valor     <input type="text" name="valor" value=<?php echo '"'.$produto->getValor().'"'?> ><br>
			Unidade   <input type="text" name="unidade" value=<?php echo '"'.$produto->getUnidade().'"'?> ><br>
			Quantidade<input type="text" name="quantidade" value=<?php echo '"'.$produto->getQuantidade().'"'?> ><br>
			Ativo     <input type="text" name="ativo" value=<?php echo '"'.$produto->getAtivo().'"'?> ><br>
			Categoria <select name="categoria">
						 <option value=""></option>
					  <?php
						$catController = new CategoriaController();
						$categorias = $catController->listarCategorias();						
						foreach ($categorias as $cat) {						
							if($produto->getCategoria() != null and $cat->getId() == $produto->getCategoria()->getId())
							{
								echo '<option value = "'.$cat->getId().'" selected>'.$cat->getNome().'</option>';
							}
							else
							{
								echo '<option value = "'.$cat->getId().'">'.$cat->getNome().'</option>';
							}							
						}
					  ?>
					  </select>
			<input type="submit" value="Cadastrar">
			<input type="button" value="Excluir" onclick=<?php echo "location.href='../controller/produto_post.php?excluir=".$produto->getId()."';"?> >
		</form>

		<table border="1px solid" style="border-collapse: collapse;">			
			<tr>				
				<th>ID</th>
				<th>Código</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Valor</th>
				<th>Unidade</th>
				<th>Quant.</th>
				<th>Ativo</th>
			</tr>
			<?php
				$produtos = $prodController->listarProdutos();
				foreach($produtos as $prod)
				{					
					echo '<tr>';
					echo '<td>'.$prod->getId().'</td>';
					echo '<td align="center">'.$prod->getCodigo().'</td>';
					echo '<td>'.$prod->getNome().'</td>';
					echo '<td>'.$prod->getDescricao().'</td>';
					echo '<td align="right">'.$prod->getValor().'</td>';
					echo '<td align="center">'.$prod->getUnidade().'</td>';
					echo '<td align="right">'.$prod->getQuantidade().'</td>';					
					if($prod->getAtivo() == 1)
					{
						echo '<td align="center"><img src="../img/ativo.jpg"></td>';	
					}
					else
					{
						echo '<td align="center"><img src="../img/inativo.jpg"></td>';	
					}
					echo '<td width="35px" align="center"><a href="cadproduto.php?prod='.$prod->getId().'"><img src="../img/editar.jpg"></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	</body>
</html>