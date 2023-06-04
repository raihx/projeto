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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Mensagens</title>
    <script src="js/functions.js"></script>
    <style>
        th {
            white-space: nowrap;
        }

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
    <div style="padding-right: 20px;">
        <a href="gestorindex.php" class="btn btn-primary" style="float: right;">VOLTAR</a>
    </div>
    <div class="container mt-4">

        <?php 
        
            include('../priv/aviso.php'); 
        
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="text-align:center">Vista de Mensagens
                            <form action="" method="POST">
                                <input type="submit" value="Mensagens Respondidas" name="msg_respondidas" style="float:right" class="btn btn-primary">
                                <input type="submit" value="Mensagens Não Respondidas" name="msg_nao_respondidas" style="float:left" class="btn btn-primary">
                            </form>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Método de resposta</th>
                                    <th>Mensagem</th>
                                    <th>Data</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $query = "SELECT * FROM mensagens ORDER BY data DESC";
                                    $result = mysqli_query($connection,$query);

                                    if(isset($_POST['msg_respondidas'])) {
                                        
                                        $query = "SELECT * FROM mensagens WHERE estado='Respondida' ORDER BY data DESC";
                                        $result = mysqli_query($connection,$query);
                                    
                                    } 

                                    if(isset($_POST['msg_nao_respondidas']))  {

                                        $query = "SELECT * FROM mensagens WHERE estado='Não Respondida' ORDER BY data DESC";
                                        $result = mysqli_query($connection,$query);

                                    }

                                    if(mysqli_num_rows($result) > 0) {
                                        
                                        foreach($result as $mensagem) {
                                            
                                ?>
                                        <tr>
                                            <td><span><?php echo $mensagem['email']; ?></span></td>
                                            <td><?php echo $mensagem['metodo_resposta']; ?></td>
                                            <td class="ellipsis"><span><?php echo $mensagem['mensagem']; ?></span></td>
                                            <td><span><?php echo $mensagem['data']; ?></span></td>
                                            <td><span><?php echo $mensagem['estado']; ?></span></td>
                                            <?php
                                                
                                                if($mensagem['estado'] == "Não Respondida") {
                                            
                                            ?>
                                                    <td>
                                                    
                                                        <a href="mensagem_detail.php?id_mensagem=<?php echo $mensagem['id_mensagem']; ?>" class="btn btn-info btn-sm">Detalhes</a>
                                                        <a href="mensagem_user.php?id_utilizador=<?php echo $mensagem['id_utilizador']; ?>" class="btn btn-success btn-sm">Utilizador</a>
                                                        
                                                        <form action="functions_data.php" method="POST" class="d-inline">
                                                            <button type="submit" name="mark_mensagem" value="<?php echo $mensagem['id_mensagem']; ?>" class="btn btn-danger btn-sm" onclick="getText('mark_mensagem')">Respondida</button>
                                                        </form>

                                                    </td>
                                            <?php

                                                } else {

                                            ?>
                                                    <td>
                                                    
                                                        <a href="mensagem_detail.php?id_mensagem=<?php echo $mensagem['id_mensagem']; ?>" class="btn btn-info btn-sm">Detalhes</a>
                                                        <a href="mensagem_user.php?id_utilizador=<?php echo $mensagem['id_utilizador']; ?>" class="btn btn-success btn-sm">Utilizador</a>
                                                        
                                                        <form action="functions_data.php" method="POST" class="d-inline">
                                                            <button type="submit" name="delete_mensagem" value="<?php echo $mensagem['id_mensagem']; ?>" class="btn btn-danger btn-sm" onclick="getText('delete_mensagem')">Eliminar</button>
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
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>