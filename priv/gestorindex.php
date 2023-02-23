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
    <link rel="stylesheet" href="gestorindex.css">
    <title>Gestor</title>
</head>
<body>
    <?php

    include('header_priv.php');

    ?>
    <h1>Bem-vindo de volta <?= $_SESSION['username']?></h1>
    <div class="conteudo">
        <div class="faixa">
            <div class="btn">
                <button onclick="window.location.href='msg_view.php'" class="btn-msg">Ver Mensagens</button>
            </div>
        </div>
    </div>
</body>
</html>