<?php

require "../priv/fileload.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Header</title>
</head>
<body>
    <header>
        
        <a href="index.php" class="logo">Parcesul</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="#">Histórico</a></li>
            <li><a href="#">Quem somos</a></li>
            <li><a href="#">Galeria</a></li>
        </ul>
        
        <?php

        echo $_SESSION['username'];

        ?>

        <a href="../priv/logout.php" class="button">Logout</a>
    </header>
</body>
</html>









