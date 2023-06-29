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

    <title>Artigos</title>

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
            <a href="admindex.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Vista de mensagens</h1>
            <?php 
    
                include('aviso.php');
            
            ?>
        </div>
    
        <div class="bannerTable">
            <table>
                <tr>
                    <th>Nome do artigo</th>
                    <th>Marca</th>
                    <th>Tipo de artigo</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>

                <?php 
                
                    $query = "SELECT * FROM stock ORDER BY tipo";
                    $result = mysqli_query($connection,$query);

                    if(mysqli_num_rows($result) > 0) {

                        foreach($result as $artigo) {

                ?>
                            <tr>
                                <td><?= $artigo['nome']; ?></td>
                                <td><?= $artigo['marca']; ?></td>
                                <td class="ellipsis"><span><?= $artigo['tipo']; ?></span></td>
                                <td class="center"><?= $artigo['preco']."€"; ?></td>
                                <td class="center"><?= $artigo['quantidade']; ?></td>
                                <td class="center" style="padding: 5px !important;"><img src="../images/produtos/<?=$artigo['imagem']?>" width="55px" height="55px" style="vertical-align: middle;"></td>
                                <td class="acoes">

                                    <a href="artigo_detail.php?id_artigo=<?= $artigo['id_artigo']; ?>"><button class="detalhes">Detalhes</button></a>
                                    <a href="artigo_edit.php?id_artigo=<?= $artigo['id_artigo']; ?>"><button class="edit">Editar</button></a>

                                    <form action="functions_data.php" method="POST">
                                    <button type="submit" name="delete_artigo" value="<?= $artigo['id_artigo']; ?>" onclick="getText('delete_artigo')" class="delete">Eliminar</button>
                                    </form>

                                </td>
                            </tr>
                        
                <?php

                        }

                    } else {

                        echo "<h5> Sem artigos registados </h5>";

                    }

                ?>
            </table>
        </div>
    </div>
</body>
</html>