<?php 

require "../priv/connection.php";

$id_utilizador = $_SESSION['id'];
  

$queryCarrinho = "SELECT SUM(quantidade) as quantidade FROM carrinho WHERE id_utilizador='$id_utilizador'";
$query_run = mysqli_query($connection,$queryCarrinho);
$carrinhoQuantidade = mysqli_fetch_array($query_run);

if($query_run) {

    if($carrinhoQuantidade['quantidade'] == NULL) {

        $_SESSION['quantidadeCarrinho'] = 0;

    } else {
        
        $_SESSION['quantidadeCarrinho'] = $carrinhoQuantidade['quantidade'];
    
    }

} else {

    $_SESSION['alerta'] = "Erro ao consultar carrinho";

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <title>Header</title>
</head>
<body>

    <header>
        <?php
            switch($_SESSION['cargo']) {

                case 'gestor':
        ?>
                    <a href="../priv/gestorindex.php" class="logo">Parcesul</a>
        <?php
                break;

                case 'administrador':                            
        ?>
                    <a href="../priv/admindex.php" class="logo">Parcesul</a>
        <?php
                break;

                case 'utilizador':                            
        ?>
                    <a href="../publ/index.php" class="logo">Parcesul</a>
        <?php
                break;

            }

        ?>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="catalogo.php">Catálogo</a></li>
            <li><a href="sobre_nos.php">Sobre nós</a></li>
            <li><a href="galeria.php">Galeria</a></li>
        </ul>

        <div class="headerRight">
            <a href="../publ/carrinho.php" class="carrinho"><img src="../images/icons/carrinho-icon.png" width="20" height="20"><?= $_SESSION['quantidadeCarrinho'] ?></a>
            <div class="dropdown">
                <div class="conta">
                    <img src="../images/icons/conta-icon.png" width="25" height="25"><a>Conta</a><img src="../images/icons/arrow_down-icon.png" width="10" height="10">
                </div>
                <div class="dropdown-menu">
                    <a href="../publ/utilizador.php?id_utilizador=<?= $_SESSION['id'] ?>">
                        <?php
                            echo $_SESSION['username'];
                        ?>
                    </a>
                    <a href="../priv/logout.php" class="logout"><img src="../images/icons/logout-icon.png" width="20" height="20">Logout</a>
                </div>
            </div>
        </div>
            
    </header>
</body>
</html>









