<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

?>

<!DOCTYPE html>
<html lang="pt">

    <head>
        <title> Parcesul </title>
        
        <link rel="stylesheet" href="styleindex.css">
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
        
        <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
        <script>  
            $(function(){ 
            $("#header").load("header.php");  
            $("#footer").load("footer.php");  
            }); 
        </script> 
        
    </head>
    <body>
        <div id="header"></div> 
        <div class ="background">
            <div class="conteudo"> 
                <h1> Realizamos a sua cozinha de sonho </h1>
                <p> Alguma d&uacutevida contacte-nos </p>
            </div>
            
        </div>
    </body>
</html>