<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

$error = " ";

if(isset($_GET['id_produto'])) {

    $id_produto = mysqli_real_escape_string($connection, $_GET['id_produto']);
    $query = "SELECT * FROM stock WHERE id_artigo='$id_produto' LIMIT 1";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0) {

        $produto = mysqli_fetch_array($query_run);

        if($produto['quantidade'] == 0) {

            $error = "Produto esgotado";
    
        } elseif($produto['quantidade'] > 0 && $produto['quantidade'] < 10) {

            $error = "Poucas unidades";

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
    
    <link rel="stylesheet" href="css/produto.css">
    
    <title><?=$produto['nome']?></title>

</head>
<body>
    <?php
        
        include('header.php');
            
    ?>

    <div class="nomeProduto">
        <a href="../publ/catalogo.php">
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
            

            <form action="../priv/functions_data.php" method="POST" class="addCarrinho">
                <input type="hidden" name="id_utilizador" value="<?= $_SESSION['id'] ?>">
                <input type="hidden" name="id_artigo" value="<?= $produto['id_artigo'] ?>">
                <input type="hidden" name="quantidade" value="1">
                <?php 
                
                    if($error == "Produto esgotado") {
                
                ?>
                        <p class="stockErro"><img src="../images/icons/cross-icon.png" width="15" height="15"><?=$error?></p>
                        <button disabled class="disabled">Adicionar ao carrinho <img src="../images/icons/add_carrinho-icon.png" width="20" height="20"></button>
                <?php
                
                    } elseif($error == "Poucas unidades") {
                
                ?>

                        <p class="stockHalf"><img src="../images/icons/check_amarelo-icon.png" width="15" height="15"><?=$error?></p>
                        <button type="submit" name="add_carrinho">Adicionar ao carrinho <img src="../images/icons/add_carrinho-icon.png" width="20" height="20"></button>

                <?php
                
                    } else {
                
                ?>
                        <p class="stockTrue"><img src="../images/icons/check-icon.png" width="15" height="15">Produto em stock</p>
                        <button type="submit" name="add_carrinho">Adicionar ao carrinho <img src="../images/icons/add_carrinho-icon.png" width="20" height="20"></button>
                <?php

                    }
                
                ?>
            </form>

            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
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