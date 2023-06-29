<?php 

require "../priv/fileload.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Sobre nós</title>

    <link rel="stylesheet" href="css/sobre_nos.css">
</head>
<body>
  <?php

  include('header.php');

  ?>
    <div class="body">
        <div class="topo">
            <div class="titulo">
                <h1>A nossa equipa</h1>
            </div>
            <div class="row">
                <div class="card">
                    <div class="left">
                        <h2>Carlos</h2>
                        <h3>Fundador</h3>
                        <a>carlo.ceo@parcesul.pt</a>
                    </div>
                    <div class="right">
                        <img src="../images/icons/man_1-icon.png" width="100%">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="left">
                        <h2>Rafael Rodrigues</h2>
                        <h3>Desenvolvedor e Administrador TI</h3>
                        <a>rafael.rodrigues@parcesul.pt</a>
                    </div>
                    <div class="right">
                        <img src="../images/icons/man_2-icon.png" width="100%">
                    </div>
                </div>
                <div class="card">
                    <div class="left">
                        <h2>Luís Valente</h2>
                        <h3>Desenvolvedor e Administrador TI</h3>
                        <a>luis.valente@parcesul.pt</a>
                    </div>
                    <div class="right">
                        <img src="../images/icons/man_3-icon.png" width="100%">
                    </div>
                </div>
            </div>
        </div>
        <div class="middle">
            <div class="titulo">
                <h1>Informações gerais</h1>
            </div>

            <div class="halfLine">
                <div class="left">
                    <h2>Acerca da Empresa</h2>
                    <h3>A nossa empresa nasceu no dia 22 de setembro de 2020, tendo recentemente atingido os 2 anos e meio de idade</h3>
                    <p>
                        Desde o início da nossa atividade que nos especializamos em construção de cozinhas e armários costumizados. 
                        Em simultânio fornece-mos os nossos serviços à empresa <i>fabri</i> com a qual colabora-mos à aproximadamente 1 ano e meio.
                    </p>
                </div>
                <div class="right">
                    <img src="../images/logo_big.jpg" alt="Logotipo Parcesul" width="100%">
                </div>
            </div>
            <div class="halfLine2">
                <div class="left2">
                    <img src="../images/localizacao.png" alt="Localização" width="100%">
                </div>
                <div class="right2">
                    <h2>Morada</h2>
                    <h3>Rua do Ginjal , Lote 10, Cabanas 2950-685 Cabanas, Palmela, Setúbal</h3>
                    <p>A sede da nossa empresa esta localizada em Palmela, Setúbal, tendo-nos mudado recentemente para o novo estabelecimento.</p>
                </div>
            </div>
            <div class="line">
                <h2>Atividade</h2>
                <h3>CAE: 43320</3>
                <p>Montagem de trabalhos de carpintaria e de caixilharia.</p>
            </div>
        </div>
    </div>

    <?php

        include('footer.php');

    ?>
</body>
</html>