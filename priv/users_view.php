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
    <title>Utilizadores</title>
    <script src="js/functions.js"></script>

</head>
<body>
  
    <div class="container mt-4">

        <?php 
        
            include('../priv/aviso.php'); 
        
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Vista de Utilizadores
                            <a href="admindex.php" class="btn btn-primary float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Nome do utilizador</th>
                                    <th>Telemóvel</th>
                                    <th>Cargo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $query = "SELECT * FROM utilizadores ORDER BY cargo";
                                    $result = mysqli_query($connection,$query);

                                    if($result) {
                                        
                                        foreach($result as $user) {
                                
                                ?>
                                        <tr>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['nome_utilizador']; ?></td>
                                            <td><?php echo $user['telemovel']; ?></td>
                                            <td><?php echo $user['cargo']; ?></td>
                                            <td>
                                                <?php
                                                
                                                if($user['id_utilizador'] != $_SESSION['id']) {
                                                
                                                ?>
                                                    
                                                    <a href="user_edit.php?id_utilizador=<?php echo $user['id_utilizador']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                
                                                    <form action="functions_data.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_user" value="<?php echo $user['id_utilizador']; ?>" class="btn btn-danger btn-sm" onclick="getText('delete_user')">Eliminar</button>
                                                    </form>

                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php

                                        }
                                    } else {
                                        
                                        echo "<h5> No Record Found </h5>";
                                    
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