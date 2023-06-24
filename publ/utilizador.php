<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

if(isset($_GET['id_utilizador'])) {

    $id_utilizador = mysqli_real_escape_string($connection, $_GET['id_utilizador']);
    $query = "SELECT * FROM utilizadores WHERE id_utilizador='$id_utilizador' LIMIT 1";
    $query_run = mysqli_query($connection,$query);

    if(!$query_run) {

        $_SESSION['alerta'] = "Erro ao encontrar utilizador";

    } else {

        $detalhesUti = mysqli_fetch_array($query_run);
        
    }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $_SESSION['username'] ?></title>

    <link rel="stylesheet" href="css/utilizador.css">

    <script>      
        function confirmarElimConta(password) {
            var confirmar = confirm("Tem a certeza que deseja eliminar a sua conta? Esta ação será irreversível!");

            if(!confirmar) {

                event.preventDefault();

            } else {

                var passConfirm = prompt("Para confirmar introduza a sua password");

                if(passConfirm != password) {

                    event.preventDefault();
                    alert("Password incorreta");

                } else {

                    alert("Conta eliminada com sucesso!");

                }
            
            }
        }

        function changePassword(password) {
            var passConfirm = prompt("Para confirmar itroduza a password antiga");

            if(passConfirm != password) {

                event.preventDefault();
                alert("Password não alterada");

            } else {

                alert("Password alterada com sucesso!");

            }    
        }

        function togglePassword() {
            var passwordInput = document.getElementById("passwordInput");
            var toggleImage = document.getElementById("toggleImage");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleImage.src = "../images/icons/hide-icon.png";
            } else {
                passwordInput.type = "password";
                toggleImage.src = "../images/icons/show-icon.png";
            }
        }
    </script>
</head>
<body>
    <?php
                
        include('header.php');
            
    ?> 

    <div class="body">
        <div class="titulo">
            <a href="../publ/catalogo.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Detalhes da conta</h1>
            <?php 
    
                if(isset($_SESSION['alerta'])) {

                    echo $_SESSION['alerta'];
                    unset($_SESSION['alerta']);

                }
            
            ?>
        </div>
        <div class="detalhesConta">
            <div class="left">
                <a href="#alterarDetalhes">Detalhes da conta</a>
                <a href="#alterarPass">Alterar password</a>
                <a href="#eliminarConta ">Eliminar conta</a>
            </div>
            <div class="right">
                <div class="alterarDetalhes">
                    <h3>Alterar detalhes da conta:</h3>
                    <br>
                    <form action="../priv/functions_data.php" method="post">
                        <input type="hidden" name="id_utilizador" value="<?= $detalhesUti['id_utilizador'] ?>">
                        <div>
                            <fieldset>
                                <label>Email:</label>
                                <br>
                                <input type="email" name="email" value="<?= $detalhesUti['email'] ?>">
                            </fieldset>
                            <fieldset>
                                <label>Nome de utilizador:</label>
                                <br>
                                <input type="text" name="nome_utilizador" value="<?= $detalhesUti['nome_utilizador'] ?>">
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <label>Nº de telemóvel:</label>
                                <br>
                                <input type="text" name="telemovel" value="<?= $detalhesUti['telemovel'] ?>">
                            </fieldset>
                            <button type="submit" name="edit_user_uti"><img src="../images/icons/edit-icon.png" width="20" height="20">Guardar alterações</button>
                        </div>
                        
                        <?php 
            
                            if(isset($_SESSION['alerta'])) {

                                echo $_SESSION['alerta'];
                                unset($_SESSION['alerta']);

                            }
                        
                        ?>
                    </form>
                </div>
        
                <div class="alterarPass" id="alterarPass">
                    <h3>Alterar a password:</h3>
                    <form action="../priv/functions_data.php" method="POST">
                        <input type="hidden" name="id_utilizador" value="<?= $detalhesUti['id_utilizador'] ?>">
                        <div>
                            <input type="password" name="password" value="<?= $_SESSION['password'] ?>" id="passwordInput"><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage" onclick="togglePassword()">
                        </div>
                        <button type="submit" name="edit_password" value="<?= $_SESSION['id'] ?>" onclick="changePassword(<?= $_SESSION['password'] ?>)"><img src="../images/icons/edit-icon.png" width="20" height="20">Alterar password</button>
                    </form>
                </div>

                <div class="eliminarConta" id="eliminarConta">
                    <h3>Eliminar a conta:</h3>
                    <form action="../priv/functions_data.php" method="POST">
                        <button type="submit" name="eliminar_conta" value="<?= $_SESSION['id'] ?>" onclick="confirmarElimConta(<?= $_SESSION['password'] ?>)"><img src="../images/icons/eliminar-icon.png" width="20" height="20">Eliminar conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

        include('footer.php');

    ?>
</body>
</html>