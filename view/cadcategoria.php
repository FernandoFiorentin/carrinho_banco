<?php 
	session_start();
	include_once '../controller/categoria_controller.php';
	include_once '../model/categoria.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<a href="../index.php">Voltar para Menu</a>
		<h2>Cadastro de Categoria</h2>
	</head>
	<body>
		<?php
			$catController = new CategoriaController();

			if(isset($_GET['cat']))
			{
				$categoria = $catController->getById($_GET['cat']);				
			}
			else
			{
				$categoria = new Categoria('','','','');
			}
		?>

		<form name="CadCategoria" method="post" action="../controller/categoria_post.php">
			ID 		  <input type="text" name="id" value=<?php echo '"'.$categoria->getId().'"'?> ><br>
			Nome 	  <input type="text" name="nome" value=<?php echo '"'.$categoria->getNome().'"'?> ><br>
			Descricao <input type="text" name="descricao" value=<?php echo '"'.$categoria->getDescricao().'"'?> ><br>
			Ativo     <input type="text" name="ativo" value=<?php echo '"'.$categoria->getAtivo().'"'?> ><br>
			<input type="submit" value="Cadastrar">
			<input type="button" value="Excluir" onclick=<?php echo "location.href='../controller/categoria_post.php?excluir=".$categoria->getId()."';"?> >
		</form>

		<table border="1px solid" style="border-collapse: collapse;">			
			<tr>				
				<th>ID</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Ativo</th>

			</tr>
			<?php
				$categorias = $catController->listarCategorias();
				foreach($categorias as $cat)
				{
					echo '<tr>';
					echo '<td>'.$cat->getId().'</td>';
					echo '<td>'.$cat->getNome().'</td>';
					echo '<td>'.$cat->getDescricao().'</td>';
					
					if($cat->getAtivo() == 1)
					{
						echo '<td align="center"><img src="../img/ativo.jpg"></td>';	
					}
					else
					{
						echo '<td align="center"><img src="../img/inativo.jpg"></td>';	
					}
					echo '<td width="35px" align="center"><a href="cadcategoria.php?cat='.$cat->getId().'"><img src="../img/editar.jpg"></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	</body>
</html>