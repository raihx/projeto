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

    <title> Parcesul </title>  

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php
            
        include('header.php');
        
    ?> 
        
    <div class="body"> 
        <div class="topo">
            <div class="left">
                <div class="slideshow">
                    <?php
                
                        include('slideshow.html');

                    ?>
                </div>
            </div>
            <div class="right">
                <h1> Realizamos a sua cozinha de sonho!</h1>
                <p>
                    Especializados em montagem de cosinhas personalizadas, onde procuramos sempre excelência e a total satisfação do cliente.
                    Os nossos serviços são também prestados à empresa <a href="https://fabri.pt/?gclid=Cj0KCQjw7uSkBhDGARIsAMCZNJvj_F4dTCk1ZdNDzuBOnu1_Nfy256HLPxMkLRLqLjsC5QZgR7kh0O8aAh5YEALw_wcB" target="_blank"><i>fabri</i></a> , com a qual colaboramos há mais de 1 ano.
                </p>
            </div> 
        </div>
        
        <div class="middle">
            <div class="titulo">
                <h1> Os nossos projetos!</h1>
                <p>Para ver mais, dirija-se à nossa <a href="../publ/galeria.php">galeria</a>.</p>
            </div>

            <div class="halfLine">
                <div class="left">
                    <h1>Cozinhas</h1>
                    <p>
                        A nossa especialidade e foco de trabalho passa principalmente pela construção de cosinhas, sendo feitas à medida da casa e espaço em questão. 
                        A comunicação com o cliente é outro fator que preservamos de maneira a tentar atingir o resultado mais ideal possível. 
                    </p>
                </div>

                <div class="right">
                    <img src="../images/000006.jpg" alt="Cozinha" width="100%" height="fit-content">
                </div>
            </div>

            <div class="halfLine2">
                <div class="left2">
                    <img src="../images/000009.jpg" alt="Cozinha" width="100%" height="fit-content">
                </div>

                <div class="right2">
                    <h1>Guarda-roupas</h1>
                    <p>
                        Para além de realizarmos cozinhas também realizamos armários persolanizados e à medida do espaço, de maneira a obter o resultado perfeito para o quarto ou espaço de arrumação do cliente.
                    </p>
                </div>
            </div>

            <div class="cards">
                <div class="card">
                    <h1>Contacte-nos</h1>
                    <p>
                        Estamos sempre disponíveis para responder a quaisquer perguntas ou pedidos, basta enviar-nos uma mensagem!
                    </p>
                    <a href="../publ/contacto.php">
                        <button>Saiba mais <img src="../images/icons/right_arrow-icon.png" width="20px" height="20px"></button>
                    </a>
                </div>
                <div class="card">
                    <h1>Conheça-nos</h1>
                    <p>
                        Venha conhecer os membros da nossa equipa, as especialidades e as nossas informações.
                    </p>
                    <a href="../publ/sobre_nos.php">
                        <button>Saiba mais <img src="../images/icons/right_arrow-icon.png" width="20px" height="20px"></button>
                    </a>    
                </div>
                <div class="card">
                    <h1>Aproveite</h1>
                    <p>
                        Conheça mais sobre os nossos projetos já finalizados através da documentação fotográfica dos mesmos.
                    </p>
                    <a href="../publ/galeria.php">
                        <button>Saiba mais <img src="../images/icons/right_arrow-icon.png" width="20px" height="20px"></button>
                    </a>
                </div>
            </div>
        </div>
    </div>        

    <?php

        include('footer.php');

    ?>

</body>
</html>