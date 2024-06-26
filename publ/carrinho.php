<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/carrinho.css">

    <title>Carrinho</title>

</head>
<body>
    <?php
                
        include('header.php');
            
    ?> 

    <div class="body">
        <div class="titulo">
            <a href="../publ/catalogo.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Carrinho de <?= $_SESSION['username'] ?></h1>
            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
        </div>
        
        <div class="carrinhoList">
            <div class="left">
                <table>
                    <th colspan="2">Produto</th>
                    <th colspan="3">Quantidade</th>
                    <th colspan="2">Preço</th>
                    <?php 
                        
                        $id_utilizador = $_SESSION['id'];
                        $query = "SELECT stock.id_artigo, stock.imagem, stock.nome, carrinho.quantidade, SUM(carrinho.quantidade) * stock.preco AS preco 
                                  FROM carrinho, stock 
                                  WHERE carrinho.id_artigo = stock.id_artigo 
                                  AND carrinho.id_utilizador = '$id_utilizador'
                                  GROUP BY stock.id_artigo";
                        $result = mysqli_query($connection,$query);

                        if(mysqli_num_rows($result) == 0) {

                            $_SESSION['alerta'] = "Nenhum item adicionado ao carrinho!";
                        
                        } else {

                            foreach($result as $produto) {
                                
                                $id_artigo = $produto['id_artigo']
                    ?>
                                <tr>
                                    <td><img src="../images/produtos/<?= $produto['imagem'] ?>" width="50px" height="50px"/></td>
                                    <td><?= $produto['nome']; ?></td>
                                    <form action="../priv/functions_data.php" method="post">
                                        <input type="hidden" name="id_utilizador" value="<?= $_SESSION['id'] ?>">
                                        <input type="hidden" name="id_artigo" value="<?= $produto['id_artigo'] ?>">
                                        <input type="hidden" name="quantidade" value="1"> 
                                    <td>
                                        <button type="submit" name="remove_carrinho"><img src="../images/icons/minus-icon.png" width="20px" height="20px"/></button>
                                    </td>
                                    <td><?= $produto['quantidade']; ?></td>
                                    <?php 
                                    
                                        $query = "SELECT * FROM stock WHERE id_artigo='$id_artigo'";
                                        $query_run = mysqli_query($connection,$query);

                                        foreach($query_run as $qntCheck) {
                                            
                                            $qnt = $qntCheck['quantidade'];

                                        }

                                        if($qnt > 0) {
                                    
                                    ?>
                                            <td>
                                                <button type="submit" name="add_carrinho"><img src="../images/icons/add-icon.png" width="20px" height="20px"/></button>
                                            </td>
                                    <?php

                                        } else {

                                    ?>

                                            <td>
                                                <button disabled class="addDisabled"><img src="../images/icons/add-icon.png" width="20px" height="20px"/></button>
                                            </td>

                                    <?php

                                        }

                                    ?>
                                    <td><?= $produto['preco']."€"; ?></td> 
                                    <td>
                                        <button type="submit" name="eliminar_carrinho"><img src="../images/icons/cross-icon.png" width="20px" height="20px"/></button>
                                    </td>
                                    </form>
                                </tr>
                    <?php
                            
                            }
                    
                        }
                        
                    ?>
                        
                </table>
            </div>
            <div class="right">
                <h1>Preço Total:</h1>
                <?php 

                    $id_utilizador = $_SESSION['id'];
                    $query = "SELECT SUM(stock.preco * carrinho.quantidade) AS precoTotal FROM stock, carrinho WHERE stock.id_artigo = carrinho.id_artigo AND carrinho.id_utilizador='$id_utilizador'";
                    $result = mysqli_query($connection,$query);

                    if(!$result) {

                        echo "Erro ao calcular o preço total";

                    } else {

                        $precoTotal = mysqli_fetch_array($result);

                        if($precoTotal['precoTotal'] == NULL) {

                ?>
                            <h2 class="precoTotal">0€</h2>
                            <a href="#">
                                <button class="compraDisabled"><img src="../images/icons/compra-icon.png" width="30" height="30">Checkout</button>
                            </a>
                <?php

                        } else {

                ?>
                        <h2 class="precoTotal"><?= $precoTotal['precoTotal']."€" ?></h2>
                        <form action="../publ/checkout.php" method="POST">
                            <input type="hidden" name="id_utilizador" value="<?= $_SESSION['id'] ?>">
                            <button class="compraBtn" name="checkout"><img src="../images/icons/compra-icon.png" width="30" height="30">Checkout</button>
                        </form>
                <?php

                        }
                    
                    }
                
                ?>
            </div> 
        </div>
    </div>
    

    <?php

        include('footer.php');

    ?>
</body>
</html>