<?php

require "../priv/fileload.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Adicionar Artigos</title>
    <script src="js/functions.js"></script>
</head>
<body>
  
    <div class="container mt-5">
    <?php 
        
    include('../priv/aviso.php'); 
        
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Artigo 
                            <a href="artigos_view.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="functions_data.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label>Nome do Artigo</label>
                                <input type="text" name="nome_artigo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Marca</label>
                                <input type="text" name="marca_artigo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Descrição</label>
                                <input type="text" name="descricao_artigo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Tipo de Artigo</label>
                                <select name="tipo_artigo" class="form-control">
                                    <option disabled selected value value="">...</option>
                                    <option value="Congelador">Congelador</option>
                                    <option value="Esquentador">Esquentador</option>
                                    <option value="Exaustor">Exaustor</option>
                                    <option value="Fogão">Fogão</option>
                                    <option value="Forno">Forno</option>
                                    <option value="Frigorífico">Frigorífico</option>
                                    <option value="Máquina de lavar loiça">Máquina de lavar loiça</option>
                                    <option value="Máquina de lavar roupa">Máquina de lavar roupa</option>
                                    <option value="Micro-ondas">Micro-ondas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Preço</label>
                                <input type="text" name="preco_artigo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>imagem</label>
                                <input type="file" name="imagem_artigo" class="form-control">
                                <p style="color:red">
                                    <?php 
                                    
                                        if(isset($_SESSION['erro_imagem'])) {

                                            echo $_SESSION['erro_imagem'];

                                        }

                                    ?>
                                </p>
                            </div>
                            <br>
                            <div class="mb-3">
                                <button type="submit" name="add_artigo" class="btn btn-primary" onclick="getText('add_artigo')">Guardar Artigo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>