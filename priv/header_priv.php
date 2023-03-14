<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header_priv.css">
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

            }

        ?>
        <ul>
            <li><a href="../publ/index.php">Visão de Utilizador</a></li>
        </ul>    

        <a href="../priv/logout.php" class="button">Logout</a>
    </header>
</body>
</html>