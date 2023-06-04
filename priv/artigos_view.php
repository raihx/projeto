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
    <title>Artigos</title>
    <script src="js/functions.js"></script>
    <style>
        th {
            white-space: nowrap;
            text-align: center;
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
    
    <div class="container mt-4">
        <a href="admindex.php" class="btn btn-primary float-end" style="margin-left: 20px;">VOLTAR</a>
    <?php 
        
        include('../priv/aviso.php'); 
        
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Vista de Artigos
                            <a href="artigo_add.php" class="btn btn-primary float-end">ADICIONAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do artigo</th>
                                    <th>Marca</th>
                                    <th>Descrição</th>
                                    <th>Tipo de artigo</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Imagem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     
                                    $query = "SELECT * FROM stock ORDER BY tipo";
                                    $result = mysqli_query($connection,$query);

                                    if(mysqli_num_rows($result) > 0) {
                                        
                                        foreach($result as $artigo) {
                                            
                                ?>
                                        <tr>
                                            <td><?php echo $artigo['nome']; ?></td>
                                            <td><?php echo $artigo['marca']; ?></td>
                                            <td class="ellipsis"><span><?php echo $artigo['descricao']; ?></td></span>
                                            <td><?php echo $artigo['tipo']; ?></td>
                                            <td><?php echo $artigo['preco']."€"; ?></td>
                                            <td><?php echo $artigo['quantidade']; ?></td>
                                            <td><img src="../images/produtos/<?=$artigo['imagem']?>" width="100px" height="100px"/></td>
                                            <td>
                                            
                                            <a href="artigo_detail.php?id_artigo=<?= $artigo['id_artigo']; ?>" class="btn btn-info btn-sm">Detalhes</a>
                                                <a href="artigo_edit.php?id_artigo=<?php echo $artigo['id_artigo']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                
                                                <form action="functions_data.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_artigo" value="<?php echo $artigo['id_artigo']; ?>" class="btn btn-danger btn-sm" onclick="getText('delete_artigo')">Eliminar</button>
                                                </form>

                                            </td>
                                        </tr>
                                <?php

                                        }
                                        
                                    } else {
                                        
                                        echo "<h5> Sem artigos registados </h5>";
                                    
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