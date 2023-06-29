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
    
    <link rel="stylesheet" href="css/admindex.css">
    
    <title>Administrador</title>
</head>
<body>
    <?php

        include('header_priv.php');

    ?>
    <div class="body">
        <div class="titulo">
            <h1>Bem-vindo de volta <?= $_SESSION['username']?></h1>
        </div>
        
        <div class="main">
            <div class="left">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </tr>
                    
                    <?php
                    
                        $query = "SELECT * FROM stock ORDER BY quantidade LIMIT 5";
                        $result = mysqli_query($connection,$query);

                        if(mysqli_num_rows($result) > 0) {
                            
                            foreach($result as $artigos) {
                    ?>

                            <tr>
                                <td><?= $artigos['nome'] ?></td>
                                <td><?= $artigos['quantidade'] ?></td>
                                <td><?= $artigos['preco'] . "€" ?></td>
                            </tr>

                    <?php

                            }

                        } else {
                            
                            echo "<h5> Sem Mensagens registadas </h5>";
                            
                        }

                    ?>
                </table>
            </div>

            <div class="right">
                <a href="users_view.php" >
                    <div class="buttonBox users">
                        <img src="../images/icons/conta-icon.png" width="50px" height="50px">
                        <h2>Gerir utilizadores</h2>
                    </div>
                    
                </a>

                <a href="artigos_view.php" class="buttonBox stock">
                    <img src="../images/icons/stock-icon.png" width="50px" height="50px">
                    <h2>Gerir stock</h2>
                </a>
            </div>
        </div>  
    </div>
</body>
</html>
