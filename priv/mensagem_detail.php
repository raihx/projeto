<?php

require "../priv/fileload.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Detalhes da Mensagem</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes da Mensagem 
                            <a href="msg_view.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        
                        if(isset($_GET['id']))
                        {
                            $msg_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM mensagens WHERE id='$msg_id' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $mensagem = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="mb-3">
                                        <label>ID da mensagem</label>
                                        <p class="form-control">
                                            <?=$mensagem['id'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <p class="form-control">
                                            <?=$mensagem['email'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Método de resposta</label>
                                        <p class="form-control">
                                            <?=$mensagem['metodo_resposta'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Mensagem</label>
                                        <p class="form-control">
                                            <?=$mensagem['mensagem'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Data</label>
                                        <p class="form-control">
                                            <?=$mensagem['data'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Estado</label>
                                        <p class="form-control">
                                            <?=$mensagem['estado'];?>
                                        </p>
                                    </div>

                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>