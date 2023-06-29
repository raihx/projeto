<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Galeria</title>

    <link rel="stylesheet" href="css/galeria.css">
</head>
<body>
    <?php
    
        include('header.php');
        
    ?> 

    <div class="body">
        <div class="banner">
            <h1>Projeto cozinha</h1>
            <div class="imagens">
                <div class="antes">
                    <h3>Antes</h3>
                    <img src="../images/000001.jpg" alt="Cozinha antes" width="100%">
                </div>
                <div class="durante">
                    <h3>Durante</h3>
                    <img src="../images/000003.jpg" alt="Cozinha durate" width="100%">
                </div>
                <div class="depois">
                    <h3>Depois</h3>
                    <img src="../images/000005.jpg" alt="Cozinha depois" width="100%">
                </div>
            </div>
        </div>
        <div class="banner">
            <h1>Projeto closet</h1>
            <div class="imagens">
                <div class="antes">
                    <h3>Antes</h3>
                    <img src="../images/000011.jpg" alt="Cozinha antes" width="100%">
                </div>
                <div class="durante">
                    <h3>Durante</h3>
                    <img src="../images/000012.jpg" alt="Cozinha durate" width="100%">
                </div>
                <div class="depois">
                    <h3>Depois</h3>
                    <img src="../images/000013.jpg" alt="Cozinha depois" width="100%">
                </div>
            </div>
        </div>
        <div class="banner">
            <h1>Projeto cozinha</h1>
            <div class="imagens">
                <div class="antes">
                    <h3>Antes</h3>
                    <img src="../images/000009.jpg" alt="Cozinha antes" width="100%">
                </div>
                <div class="durante">
                    <h3>Durante</h3>
                    <img src="../images/000006.jpg" alt="Cozinha durate" width="100%">
                </div>
                <div class="depois">
                    <h3>Depois</h3>
                    <img src="../images/000007.jpg" alt="Cozinha depois" width="100%">
                </div>
            </div>
        </div>
    </div>

    <?php

        include('footer.php');

    ?>
</body>
</html>
    
       