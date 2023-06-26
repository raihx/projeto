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
                <h1>Equipa</h1>
            </div>
            <table>
                <tr>
                    <td>
                        <div class="card"> 
                            <div class="container">
                                <br><h2>Carlos</h2><br>
                                <p class="title">Fundador</p><br>
                                <p>CEO e principal força trabalhadora da Parcesul</p><br>
                                <p>founder@parcesul.pt</p><br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card"> 
                            <div class="container">
                                <br><h2>Rafael Rodrigues</h2><br>
                                <p class="title">Desenvolvedor</p><br>
                                <p>Desenvolvedor do presente website</p><br>
                                <p>rafa.rodrigues@parcesul.pt</p><br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card"> 
                            <div class="container">
                                <br><h2>Luís Valente</h2><br>
                                <p class="title">Desenvolvedor</p><br>
                                <p>Desenvolvedor do presente website</p><br>
                                <p>luis.valente@parcesul.pt</p><br>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="middle">
            <div class="titulo">
                <h1>Acerca de</h1>
                <p><a href="https://www.racius.com/parcesul-unipessoal-lda/" target ="_blank">Clique Aqui !</a></p>
            </div>
            
            <table>
                <tr>
                    <td>
                        <div class="card"> 
                            <div class="container">
                                <h2>Acerca da Empresa</h2>
                                <p>A empresa Parcesul tem 2 anos, tendo sido constituída em 22/09/2020.</p><br>
                                <p>A sua sede fica localizada em Palmela.</p><br>
                                <p>O capital social é de € 250,00.</p><br>
                                <p>Desenvolve a sua atividade principal no âmbito de Montagem de trabalhos de carpintaria e de caixilharia.</p><br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card">
                            <div class="container">
                                <h2>Morada</h2>
                                <p class="title">Palmela, Setúbal</p><br>
                                <p>Rua do Ginjal , Lote 10, Cabanas 2950-685 Cabanas</p><br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card">
                            <div class="container">
                                <h2>Atividade</h2>
                                <p class="title">CAE: 43320</p><br>
                                <p>Montagem de trabalhos de carpintaria e de caixilharia.</p><br>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php

        include('footer.php');

    ?>
</body>
</html>