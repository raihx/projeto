<?php

require "../priv/fileload.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Detalhes de Utilizador</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes de Utilizador 
                            <a href="mensagens_view.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        
                        if(isset($_GET['id_utilizador'])) {

                            $id_utilizador = mysqli_real_escape_string($connection, $_GET['id_utilizador']);
                            $query = "SELECT * FROM utilizadores WHERE id_utilizador='$id_utilizador' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $user_msg = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <p class="form-control">
                                            <?=$user_msg['email'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nome de utilizador</label>
                                        <p class="form-control">
                                            <?=$user_msg['nome_utilizador'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Telemóvel</label>
                                        <p class="form-control">
                                            <?=$user_msg['telemovel'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Cargo</label>
                                        <p class="form-control">
                                            <?=$user_msg['cargo'];?>
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