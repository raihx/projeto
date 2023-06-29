<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_priv.css">
    <title>Header</title>
</head>
<body>
    <header>
        <?php
            switch($_SESSION['cargo']) {

                case 'administrador':
        ?>
                    <a href="../priv/admindex.php" class="logo">Parcesul</a>

                    <ul class="menu">
                        <li><a href="../publ/index.php">Visão de Utilizador</a></li>
                        <li><a href="users_view.php">Utilizadores</a></li>
                        <li><a href="artigos_view.php">Stock</a></li>
                    </ul> 
        <?php
                break;

                case 'gestor':                            
        ?>
                    <a href="../priv/gestorindex.php" class="logo">Parcesul</a>

                    <ul class="menu">
                        <li><a href="../publ/index.php">Visão de Utilizador</a></li>
                        <li><a href="mensagens_view.php">Mensagens</a></li>
                    </ul> 
        <?php
                break;

            }

        ?>

        <div class="headerRight">
            <a href="logout.php"><img src="../images/icons/logout-icon.png" width="20" height="20">Logout</a>
        </div>
    </header>
</body>
</html>