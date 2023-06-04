<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

if(isset($_GET['id_utilizador'])) {

    $id_utilizador = mysqli_real_escape_string($connection, $_GET['id_utilizador']);
    $query = "SELECT * FROM utilizadores WHERE id_utilizador='$id_utilizador' LIMIT 1";
    $query_run = mysqli_query($connection,$query);

    if(!$query_run) {

        $_SESSION['alerta'] = "Erro ao encontrar utilizador";

    } else {

        $detalhesUti = mysqli_fetch_array($query_run);

    }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $_SESSION['username'] ?></title>

    <link rel="stylesheet" href="css/utilizador.css">
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
            <h1>Detalhes da conta</h1>
            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
        </div>
        <div class="detalhesConta">
            <div class="left">
                <a href="#">Detalhes da conta</a>
                <a href="#">Alterar password</a>
                <a href="#">Eliminar conta</a>
            </div>
            <div class="right">
                <form action="../priv/functions_data.php" method="post">
                    <input type="hidden" name="id_utilizador" value="<?= $detalhesUti['id_utilizador'] ?>">
                    <br>
                    <input type="email" name="email" value="<?= $detalhesUti['email'] ?>">
                    <input type="text" name="nome_utilizador" value="<?= $detalhesUti['nome_utilizador'] ?>">
                    <br>
                    <input type="number" name="telemovel" value="<?= $detalhesUti['telemovel'] ?>">
                    <button type="submit" name="edit_user_uti"><img src="../images/icons/edit-icon.png" width="25" height="25">Guardar alterações</button>
                    <?php 
        
                        if(isset($_SESSION['alerta'])) {

                            echo $_SESSION['alerta'];
                            unset($_SESSION['alerta']);

                        }
                    
                    ?>
                </form>
            </div>
        </div>
    </div>

    <?php

        include('footer.php');

    ?>
</body>
</html>