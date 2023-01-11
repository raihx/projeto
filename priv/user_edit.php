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

    <title>Editar Utilizador</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('aviso.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Utilizador
                            <a href="users_view.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php

                        if(isset($_GET['email'])) {

                            $user_email = mysqli_real_escape_string($connection, $_GET['email']);
                            $query = "SELECT * FROM utilizadores WHERE email='$user_email' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0) {

                                $userdata = mysqli_fetch_array($query_run);
                                
                                ?>
                                
                                <form action="functions_adm.php" method="POST">
                                    
                                    <input type="hidden" name="user_id" value="<?= $userdata['email']; ?>">

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$userdata['email'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Nome de  Utilizador</label>
                                        <input type="text" name="username" value="<?=$userdata['nome_utilizador'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Telemóvel</label>
                                        <input type="text" name="telemovel" value="<?=$userdata['telemovel'];?>" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label>Cargo</label>
                                        <select name="cargo" class="form-control">
                                            <option value="<?=$userdata['cargo'];?>"> <?=$userdata['cargo'];?> </option>
                                            <?php
                                                
                                                if($userdata['cargo'] == 'utilizador') {
                                                    
                                                    echo "<option> gestor </option>";
                                                    echo "<option> administrador </option>";

                                                } elseif($userdata['cargo'] == 'gestor') {
                                                    
                                                    echo "<option> utilizador </option>";
                                                    echo "<option> administrador </option>";

                                                } elseif($userdata['cargo'] == 'administrador') {
                                                    
                                                    echo "<option> utilizador </option>";
                                                    echo "<option> gestor </option>";

                                                }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary" onclick="aviso_edit()">Atualizar Utilizador</button>
                                    </div>
                                </form>
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