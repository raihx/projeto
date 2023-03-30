<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="functions.js"></script>

    <title>Editar Artigos</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('aviso.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Artigo
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

                                $artigo_data = mysqli_fetch_array($query_run);
                                
                                ?>
                                
                                <form action="functions_data.php" method="POST">
                                    
                                    <input type="hidden" name="artigo_id" value="<?= $artigo_data['id']; ?>">

                                    <div class="mb-3">
                                        <label>Nome do artigo</label>
                                        <input type="email" name="nome_artigo" value="<?=$artigo_data['nome'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Marca</label>
                                        <input type="text" name="marca_artigo" value="<?=$artigo_data['marca'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <input type="text" name="descricao_artigo" value="<?=$artigo_data['descricao'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Tipo de artigo</label>
                                        <input type="text" name="tipo_artigo" value="<?=$artigo_data['tipo'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Preço</label>
                                        <input type="text" name="preco_artigo" value="<?=$artigo_data['preco']."€";?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Quantidade</label>
                                        <input type="number" name="quantidade_artigo" value="<?=$artigo_data['quantidade'];?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Imagem</label>
                                        <br>
                                        <img src="../images/<?=$artigo_data['imagem']?>">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="edit_artigo" class="btn btn-primary" onclick="getText('edit_artigo')">Atualizar Artigo</button>
                                    </div>
                                </form>
                                <?php
                            
                            } else {
                                
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