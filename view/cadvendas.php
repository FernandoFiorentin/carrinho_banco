<?php
session_start();
include_once '../controller/controllerProduto.php';
include_once '../controller/controllerCategoria.php';
include_once '../controller/controllerVenda.php';
include_once '../model/produto.php';
include_once '../model/categoria.php';
include_once '../model/venda.php';
?>

<html>
    <head>
    <a href="../index.php">Voltar para Menu</a>
    <h2>Vendas</h2>
</head>
<body>

    <?php
    $vendController = new VendaController();
    if (isset($_GET['acao'])) {
        if ($_GET['acao'] == 'editar') {
            $venda = $vendController->buscarPorId($_GET['vend']);
        }
        $acao = $_GET['acao'];
    } else {
        $venda = new Venda();
        $acao = 'inserir';
    }
    ?>

    <form name="CadVenda" method="post" action="../controller/preControllerVenda.php">
        <input type="hidden" name="acao" value="<?php echo $acao; ?>">
        ID        <input type="text" name="id" value=<?php echo '"' . $venda->getId() . '"' ?> ><br>
        Cliente   <input type="text" name="cliente" value=<?php echo '"' . $venda->getCliente() . '"' ?> ><br>
        Desconto  <input type="text" name="desconto" value=<?php echo '"' . $venda->getDesconto() . '"' ?> ><br>
        Data      <input type="text" name="data" value=<?php echo '"' . $venda->getData() . '"' ?> ><br>
        <input type="button" value="Novo" onclick="location.href = 'cadvendas.php'">
        <input type="submit" value="Cadastrar">        
        <input type="button" value="Excluir" onclick=<?php echo "location.href='../controller/preControllerVenda.php?acao=excluir&idvenda=" . $venda->getId() . "';" ?> >
    </form>

    <table border="1px solid" style="border-collapse: collapse;">			
        <tr>				
            <th>ID</th>
            <th>Data</th>
            <th>Cliente</th>
            <th>Desconto</th>
            <th>Total</th>
        </tr>
        <?php
        $vendas = $vendController->listarVendas();
        foreach ($vendas as $vend) {
            echo '<tr>';
            echo '<td>' . $vend->getId() . '</td>';
            echo '<td>' . $vend->getData() . '</td>';
            echo '<td>' . $vend->getCliente() . '</td>';
            echo '<td>' . $vend->getDesconto() . '</td>';
            echo '<td>' . $vend->getValorTotal() . '</td>';
            echo '<td width="35px" align="center"><a href="cadvendas.php?acao=editar&vend=' . $vend->getId() . '"><img src="../img/editar.jpg" title="editar"></a></td>';
            echo '<td width="35px" align="center"><a href="caditens.php?vend=' . $vend->getId() . '"><img src="../img/mais.jpg" title="Itens"></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
