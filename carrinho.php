<?php

session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

function adicionarProdutoAoCarrinho($produto) {
    $_SESSION['carrinho'][] = $produto;
}

if (isset($_POST['adicionar'])) {
    foreach ($_POST['adicionar'] as $key => $value) {
        $produto = array(
            'produtoImg' => $_POST['imagem_produto'][$key],
            'produtoNome' => $_POST['produto_nome'][$key],
            'produtoMarca' => $_POST['produto_marca'][$key],
            'produtoPreco' => $_POST['produto_preco'][$key],
            'produtoTipo' => $_POST['produto_tipo'][$key]
        );

        adicionarProdutoAoCarrinho($produto);
    }
}


if (isset($_GET['limpar']) && $_GET['limpar'] == 1) {
    unset($_SESSION['carrinho']);
    header('Location: carrinho.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <style>
        .produto {
            border: 1px solid black;
            margin-bottom: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Carrinho de Compras</h1>

    <!--Apresentação dos intens no banco-->

    <?php
        $totalCompra = 0;
    
        if (empty($_SESSION['carrinho'])) : 
    
    ?>
        <p>O carrinho está vazio.</p>
    <?php else : ?>
        <div>
            <?php foreach ($_SESSION['carrinho'] as $produto) : ?>
                <div class="produto">
                    <?php
                        $precoProduto = $produto['produtoPreco'];
                        $totalCompra += $precoProduto;
                    ?>
                    <img src="<?php echo $produto['produtoImg']; ?>" alt="Imagem do Produto">
                    <p><?php echo $produto['produtoNome']; ?></p>
                    <p><?php echo $produto['produtoMarca']; ?></p>
                    <p>R$ <?php echo $produto['produtoPreco']; ?></p>
                </div>
            <?php endforeach; ?>
            <?php echo "<p>Total da Compra: R$ " . number_format($totalCompra, 2, ',', '.') . "</p>"; ?>
        </div>

        <a href="carrinho.php?limpar=1">Limpar Carrinho</a>
    <?php endif; ?>
    <a href="index.php">Voltar</a>
</body>
</html>