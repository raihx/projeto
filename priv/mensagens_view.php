<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/template_view.css">

    <title>Mensagens</title>
    
    <script src="js/functions.js"></script>
    
    <style>

    .ellipsis {
        position: relative;
    }

    .ellipsis span{
        padding-left: 10px;
        position: absolute;
        left: 0;
        right: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
</head>
<body>
    <?php 
        
        include('../priv/header_priv.php'); 

    ?>

    <div class="body">
        <div class="titulo">
            <a href="gestorindex.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Vista de mensagens</h1>
            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
        </div>
    
        <div class="msgForm">
            <form action="" method="POST">
                <select name="msg_estado">
                    <option disabled selected value value="">...</option>
                    <option value="Não respondidas">Não respondidas</option>
                    <option value="Respondidas">Respondidas</option>
                    <option value="Ambas">Ambas</option>
                </select> 
                <button type="submit">Visualizar</button>
            </form>
        </div>

        <div class="bannerTable">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Método de resposta</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
                <?php 
                    
                    $query = "SELECT * FROM mensagens ORDER BY data DESC";
                    $result = mysqli_query($connection,$query);

                    if(isset($_POST['msg_estado']) && $_POST['msg_estado'] == "Respondidas") {
                        
                        $query = "SELECT * FROM mensagens WHERE estado='Respondida' ORDER BY data DESC";
                        $result = mysqli_query($connection,$query);
                        
                    } 

                    if(isset($_POST['msg_estado']) && $_POST['msg_estado'] == "Não respondidas")  {

                        $query = "SELECT * FROM mensagens WHERE estado='Não Respondida' ORDER BY data DESC";
                        $result = mysqli_query($connection,$query);

                    }

                    if(mysqli_num_rows($result) > 0) {
                        
                        foreach($result as $mensagem) {
                    
                ?>
                            <tr>
                                <td><span><?= $mensagem['email']; ?></span></td>
                                <td><?= $mensagem['metodo_resposta']; ?></td>
                                <td class="ellipsis"><span><?= $mensagem['mensagem']; ?></span></td>
                                <td class="center"><span><?= $mensagem['data']; ?></span></td>
                                <td class="center"><?= $mensagem['estado']; ?></td>
                <?php
                    
                            if($mensagem['estado'] == "Não Respondida") {
                    
                ?>
                                <td class="acoes">
                                    <a href="mensagem_detail.php?id_mensagem=<?= $mensagem['id_mensagem']; ?>"><button class="detalhes">Detalhes</button></a>
                                    <a href="mensagem_user.php?id_utilizador=<?= $mensagem['id_utilizador']; ?>"><button class="edit">Utilizador</button></a>  
                                    <form action="functions_data.php" method="POST">
                                        <button type="submit" name="mark_mensagem" value="<?= $mensagem['id_mensagem']; ?>" onclick="getText('mark_mensagem')" class="delete">Respondida</button>
                                    </form>
                                </td>
                <?php

                            } else {

                ?>
                                <td class="acoes">
                                    <a href="mensagem_detail.php?id_mensagem=<?= $mensagem['id_mensagem']; ?>"><button class="detalhes">Detalhes</button></a>
                                    <a href="mensagem_user.php?id_utilizador=<?= $mensagem['id_utilizador']; ?>"><button class="edit">Utilizador</button></a>    
                                    <form action="functions_data.php" method="POST">
                                        <button type="submit" name="delete_mensagem" value="<?= $mensagem['id_mensagem']; ?>" onclick="getText('delete_mensagem')" class="delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                <?php
                            }

                        }

                    } else {
                        
                        echo "<h5> Sem Mensagens registadas </h5>";
                        
                    }

                ?>
            </table>
        </div>
    </div>
</body>
</html>