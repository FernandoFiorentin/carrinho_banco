<?php
session_start();
include_once '../controller/controllerProduto.php';
include_once '../controller/controllerCategoria.php';
include_once '../controller/controllerVenda.php';
include_once '../controller/controllerItem.php';
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

    if (isset($_GET['acao'])) {
        if ($_GET['acao'] == 'editar') {
            $item = $itemController->buscarPorId($_GET['item'], $_GET['vend']);
        }
        $acao = $_GET['acao'];
    } else {
        $item = new Item();
        $acao = 'inserir';
    }

    $vendController = new VendaController();
    $venda = $vendController->buscarPorId($_GET['vend']);
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
        echo '<td>' . $venda->getId() . '</td>';
        echo '<td>' . $venda->getCliente() . '</td>';
        echo '<td>' . $venda->getDesconto() . '</td>';
        echo '<td>' . $venda->getData() . '</td>';
        ?>
    </table>
    <br>
    <!-- Formulario de Inserção dos Itens -->
    <form name="CadItem" method="post" action="../controller/preControllerItem.php">
        <input type="hidden" name="acao" value="<?php echo $acao; ?>">
        <input type="hidden" name="venda" value=" <?php echo $venda->getId(); ?> "> 
        ID 		   <input type="text" name="id" value=<?php echo '"' . $item->getId() . '"' ?> ><br>
        Produto <select name="produto">
            <option value=""></option>
            <?php
            $prodController = new ProdutoController();
            $produtos = $prodController->listarProdutos();
            echo '<pre>';
            print_r($produtos);
            echo '</pre>';
            foreach ($produtos as $prod) {
                if ($item->getProduto() != null and $prod->getId() == $item->getProduto()->getId()) {
                    echo '<option value = "' . $prod->getId() . '" selected>' . $prod->getNome() . '</option>';
                } else {
                    echo '<option value = "' . $prod->getId() . '">' . $prod->getNome() . '</option>';
                }
            }
            ?>
        </select><br>
        Quantidade <input type="text" name="quantidade" value=<?php echo '"' . $item->getQuantidade() . '"' ?> ><br>
        <input type="button" value="Novo" onclick="location.href = 'caditens.php?vend=<?php echo $item->getIdVenda(); ?>'">
        <input type="submit" value="Cadastrar">
        <input type="button" value="Excluir" onclick=<?php echo "location.href='../controller/preControllerItem.php?acao=excluir&item=" . $item->getId() . "&vend=" . $item->getIdVenda() . "';" ?> >
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
        if (isset($_GET['vend'])) {
            $itens = $itemController->listarItens($_GET['vend']);
            if ($itens) {
                foreach ($itens as $item) {
                    echo '<tr>';
                    echo '<td>' . $item->getId() . '</td>';
                    echo '<td>' . $item->getProduto()->getNome() . '</td>';
                    echo '<td>' . $item->getQuantidade() . '</td>';
                    echo '<td>' . $item->getProduto()->getValor() . '</td>';
                    echo '<td>' . $item->getValorTotal() . '</td>';
                    echo '<td width="35px" align="center"><a href="caditens.php?acao=editar&vend=' . $item->getIdVenda() . '&item=' . $item->getId() . '"><img src="../img/editar.jpg" title="editar"></a></td>';
                    echo '</tr>';
                }
            }
        }
        ?>
    </table>
</body>
</html>