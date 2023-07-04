<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="css/template_view.css">
    
    <title>Utilizadores</title>
    
    <script src="js/functions.js"></script>
</head>
<body>
    <?php 

        include('../priv/header_priv.php'); 

    ?>

    <div class="body">
        <div class="titulo">
            <a href="admindex.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Vista de utilizadores</h1>
            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
        </div>

        <div class="bannerTable">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Nome do utilizador</th>
                    <th>Telemóvel</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                </tr>
                <?php 

                    $query = "SELECT * FROM utilizadores ORDER BY cargo";
                    $result = mysqli_query($connection,$query);

                    if($result) {

                        foreach($result as $user) {

                ?>
                            <tr>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['nome_utilizador']; ?></td>
                                <td class="center"><?= $user['telemovel']; ?></td>
                                <td><?= $user['cargo']; ?></td>
                                <td class="acoes">
                <?php

                            if($user['id_utilizador'] != $_SESSION['id']) {

                ?>

                                    <a href="user_edit.php?id_utilizador=<?= $user['id_utilizador']; ?>"><button class="edit">Editar</button></a>

                                    <form action="functions_data.php" method="POST">
                                    <button type="submit" name="delete_user" value="<?= $user['id_utilizador']; ?>" onclick="getText('delete_user')" class="delete">Eliminar</button>
                                    </form>

                <?php
                        
                            }
                
                ?>
                                </td>
                            </tr>
                <?php

                        }
            
                    } else {

                        echo "<h5> No Record Found </h5>";

                    }

                ?>
            </table>
        </div>
    </div>
</body>
</html>