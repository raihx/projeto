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
    
    <link rel="stylesheet" href="css/catalogo.css">
    
    <title>Catálogo</title>
</head>
<body>
<?php
    
include('header.php');
    
?>

<div class="titulo">
    <h1>Eletrodomésticos à sua escolha!</h1>
    <?php 
    
        if(isset($_SESSION['alerta'])) {

            echo $_SESSION['alerta'];
            unset($_SESSION['alerta']);

        }
    
    ?>
</div>

<div class="container">
    <div class="left">
        <div class="filtros">
            <h2>Filtros de pesquisa</h2>
            <form action="" method="GET">
                <input type="checkbox" name="filtro" value=" "><a>Todos os produtos</a>
                <br>
                <input type="checkbox" name="filtro" value="Congelador"><a>Congeladores</a>
                <br>
                <input type="checkbox" name="filtro" value="Esquentador"><a>Esquentadores</a> 
                <br>
                <input type="checkbox" name="filtro" value="Exaustor"><a>Exaustores</a> 
                <br>
                <input type="checkbox" name="filtro" value="Fogão"><a>Fogões</a> 
                <br>
                <input type="checkbox" name="filtro" value="Forno"><a>Fornos</a> 
                <br>
                <input type="checkbox" name="filtro" value="Frigorífico"><a>Frigoríficos</a> 
                <br>
                <input type="checkbox" name="filtro" value="Máquina de lavar loiça"><a>Máquinas de lavar loiça</a> 
                <br>
                <input type="checkbox" name="filtro" value="Máquina de lavar roupa"><a>Máquinas de lavar roupa</a> 
                <br>
                <input type="checkbox" name="filtro" value="Micro-ondas"><a>Micro-ondas</a> 
                <br>
                <button type="submit" name="pesquisar">
                    <img src="../images/icons/pesquisar-icon.png" width="20" height="20" style="vertical-align: middle; margin-right: 10px;">
                    Pesquisar
                </button>
            </form>
        </div>
    </div>
    <div class="right">
        <?php
            $query = "SELECT id_artigo, nome, preco, quantidade, imagem FROM stock WHERE 1=1 ";

            // todo: gerar a query a partir de js, e mudar as checkbox para <a> tags

            if(isset($_GET['filtro']) && $_GET['filtro'] != null) {
                
                switch($_GET['filtro']) {
                    case "Congelador":
                        $query .= "AND tipo='Congelador' ";
                    break;
                    case "Esquentador":
                        $query .= "AND tipo='Esquentador' ";
                    break;
                    case "Exaustor":
                        $query .= "AND tipo='Exaustor' ";
                    break;
                    case "Fogão":
                        $query .= "AND tipo='Fogão' ";
                    break;
                    case "Forno":
                        $query .= "AND tipo='Forno' ";
                    break;
                    case "Frigorífico":
                        $query .= "AND tipo='Frigorífico' ";
                    break;
                    case "Máquina de lavar loiça":
                        $query .= "AND tipo='Máquina de lavar loiça' ";
                    break;
                    case "Máquina de lavar roupa":
                        $query .= "AND tipo='Máquina de lavar roupa' ";
                    break;
                    case "Micro-ondas":
                        $query .= "AND tipo='Micro-ondas' ";
                    break; 
                }

            }

            $query .= 'ORDER BY id_artigo DESC';
            $result = mysqli_query($connection,$query);

            foreach($result as $artigo) {
        ?>

        <div class="produto">
            <img src="../images/produtos/<?= $artigo['imagem']?>" alt="<?=$artigo['nome']?>" width="100px" height="100px">
            <div class="nomeProduto">
                <h3><?= $artigo['nome'] ?></h3>
            </div>
            <h4><?= $artigo['preco'] ?>€</h4>
            <ul>
                <li class="liDetails">
                    <a href="produto.php?id_produto=<?= $artigo['id_artigo'] ?>" class="details">Detalhes</a>
                </li>
                <li>
                    <form action="../priv/functions_data.php" method="post">
                        <input type="hidden" name="id_utilizador" value="<?= $_SESSION['id'] ?>">
                        <input type="hidden" name="id_artigo" value="<?= $artigo['id_artigo'] ?>">
                        <input type="hidden" name="quantidade" value="1">
                        <?php 
                        
                            if($artigo['quantidade'] > 0) {

                        ?>
                                <button type="submit" name="add_carrinho" class="addToCart"><img src="../images/icons/add_carrinho-icon.png" width="25px" height="25px"/></button>
                        <?php

                            } else {

                        ?>
                                <button disabled class="disabled"><img src="../images/icons/cross-icon.png" width="25px" height="25px"/></button>  
                        <?php

                            }
                        
                        ?>
                        
                    </form>  
                </li>
            </ul>    
        </div>

        <?php
            }
        ?>
    </div>
</div>


<?php
    
include('footer.php');
    
?>
</body>
</html>
