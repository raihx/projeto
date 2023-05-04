<?php

require "../priv/fileload.php";

$error = " ";

if(isset($_GET['id_produto'])) {

    $id_produto = mysqli_real_escape_string($connection, $_GET['id_produto']);
    $query = "SELECT * FROM stock WHERE id='$id_produto' LIMIT 1";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0) {

        $produto = mysqli_fetch_array($query_run);

        if($produto['quantidade'] == 0) {

            $error = "Produto esgotado";
    
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$produto['nome']?></title>

    <link rel="stylesheet" href="css/produto.css">
</head>
<body>
<?php
    
    include('header.php');
        
?>

    <div class="nomeProduto">
        <a href="catalogo.php">
            <button>
                <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                Voltar
            </button>
        </a>
        <h1><?=$produto['nome']?></h1>
    </div>

    <div class="infoProduto">
        <div class="left">
            <img src="../images/produtos/<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" width="400px" height="400px">
        </div>

        <div class="right">
            <ul>
                <li>
                    <h2 class="preco"><?=$produto['preco']?>€</h2>
                </li>
                <li>
                    <h2 class="marca">Marca: <?=$produto['marca']?></h2>
                </li>
            </ul>
            

            <form action="carrinho.php" method="POST" class="addCarrinho">
                <?php 
                
                    if($error != " ") {
                
                ?>
                        <p class="stockErro"><img src="../images/icons/cross-icon.png" width="15" height="15"><?=$error?></p>
                        <button disabled>Adicionar ao carrinho <img src="../images/icons/add_carrinho-icon.png" width="20" height="20"></button>
                <?php
                
                    } else {
                
                ?>
                        <p class="stockTrue"><img src="../images/icons/check-icon.png" width="15" height="15">Produto em stock</p>
                        <button type="submit">Adicionar ao carrinho <img src="../images/icons/add_carrinho-icon.png" width="20" height="20"></button>
                <?php

                    }
                
                ?>
            </form>

            <div class="descricao">
                <h3>Descrição do produto:</h3>
                <p><?=$produto['descricao']?></p>
            </div>
        </div>
    </div>

<?php
    
include('footer.php');
    
?>
</body>
</html>