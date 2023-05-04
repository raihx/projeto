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
    <h1>Bem-vindo de volta <?= $_SESSION['username']?></h1>
    <div class="conteudo">
        <div class="faixa">
            <div class="btn">
                <button onclick="window.location.href='users_view.php'" class="btn-use">Gerir Utilizadores</button>
            </div>
        </div>
        <div class="faixa">
            <div class="btn">
                <button onclick="window.location.href='artigos_view.php'" class="btn-use">Gerir Artigos</button>
            </div>
        </div>
    </div>
</body>
</html>
