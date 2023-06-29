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
    
    <link rel="stylesheet" href="css/gestorindex.css">
    
    <title>Gestor</title>
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
                        <th>Email</th>
                        <th>Método de resposta</th>
                        <th>Data</th>
                    </tr>
                    
                    <?php
                    
                        $query = "SELECT * FROM mensagens WHERE estado='Não Respondida' ORDER BY data DESC";
                        $result = mysqli_query($connection,$query);

                        if(mysqli_num_rows($result) > 0) {
                            
                            foreach($result as $mensagem) {
                    ?>

                            <tr>
                                <td><?= $mensagem['email'] ?></td>
                                <td><?= $mensagem['metodo_resposta'] ?></td>
                                <td><?= $mensagem['data'] ?></td>
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
                <a href="mensagens_view.php" >
                    <div class="buttonBox messages">
                        <img src="../images/icons/mensagens-icon.png" width="50px" height="50px">
                        <h2>Gerir Mensagens</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>