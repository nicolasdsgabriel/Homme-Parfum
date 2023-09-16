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
            'produtoPreco' => $_POST['produto_preco'][$key]
        );

        adicionarProdutoAoCarrinho($produto);
    }
}

//exclui os itens do carrinho
if (isset($_GET['remover'])) {
    $indice = $_GET['remover'];

    if (isset($_SESSION['carrinho'][$indice])) {
        unset($_SESSION['carrinho'][$indice]);
    }
}

//Limpa o carrinho
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .card{
            max-width: 65%;
            max-height: 402px;
        }
        .perfume-img{
            width: 130px;
            height: 180px;
        }
    </style>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">HOMME PARFUM</a>
            </div>
        </nav>
</header>

        <h1>Carrinho de Compras</h1>

        <!--Apresentação dos intens no banco-->

        <?php
            $totalCompra = 0;
        
            if (empty($_SESSION['carrinho'])) : 
        
        ?>
            <p>O carrinho está vazio.</p>
        <?php else :?>
            <div class="sacola">
                <?php foreach ($_SESSION['carrinho'] as $indice => $produto) : ?>
                    <div class="card mb-3 shadow p-3 mb-5 bg-body-tertiary rounded">
                        <div class="row g-0">
                            <?php
                                $precoProduto = $produto['produtoPreco'];
                                $totalCompra += $precoProduto;
                            ?>
                            <div class="col-md-4">
                                <img src="<?php echo $produto['produtoImg']; ?>" class="perfume-img img-fluid rounded-start" alt="Imagem do Produto">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                        <h3 class="card-text"><?php echo $produto['produtoNome']; ?></h3>
                                        <h5 class="card-text"><?php echo $produto['produtoMarca']; ?></h5>
                                        <p class="card-text">R$ <?php echo $produto['produtoPreco'] . ",00";?></p>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="carrinho.php?remover=<?php echo $indice; ?>" class="btn btn-warning btn-sm me-md-2 ">Excluir</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a href="carrinho.php?limpar=1">Limpar Carrinho</a>
            </div>
            <?php echo "<p>Total da Compra: R$ " . number_format($totalCompra, 2, ',', '.') . "</p>"; ?>
        <?php 
            endif;
        ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>