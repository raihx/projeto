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
                        <h4>Detalhes do Artigo 
                            <a href="artigos_view.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        
                        if(isset($_GET['id'])) {

                            $artigo_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM stock WHERE id='$artigo_id' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0) {

                                $artigo = mysqli_fetch_array($query_run);

                                ?>
                                
                                    <div class="mb-3">
                                        <label>ID do artigo</label>
                                        <p class="form-control">
                                            <?=$artigo['id'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <p class="form-control">
                                            <?=$artigo['nome'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Marca</label>
                                        <p class="form-control">
                                            <?=$artigo['marca'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <p class="form-control">
                                            <?=$artigo['descricao'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tipo</label>
                                        <p class="form-control">
                                            <?=$artigo['tipo'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Preço</label>
                                        <p class="form-control">
                                            <?=$artigo['preco'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Quantidade</label>
                                        <p class="form-control">
                                            <?=$artigo['quantidade'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Imagem</label>
                                        <br>
                                        <img src="../images/produtos/<?=$artigo['imagem']?>" width="200px" height="200px"/>
                                    </div>

                                <?php

                            } else {

                                echo "<h4>ID não encontrado</h4>";

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