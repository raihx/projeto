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
    <title>Gestor</title>
</head>
<body>
    <a href="logout.php" style="float: right;">Logout!</a>

    <div>
    
        <button onclick="window.location.href='msg_view.php'">Visualizar mensagens não respondidas</button>
        
    </div>
</body>
</html>