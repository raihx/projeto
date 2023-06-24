<?php

require "../priv/fileload.php";

$fase = "enter_email";
$error = "";
$email = "";

if(isset($_GET['fase'])) {

    $fase = $_GET['fase'];

}

if(count($_POST) > 0) {

    switch($fase) {
        
        case "enter_email":
            
            $email = addslashes($_POST['email']);

            if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
                $error = "Formato de email inválido";
            
            }

            if($error == "") { 

                $_SESSION['recover']['email'] = $email;

                $query = "SELECT * FROM utilizadores WHERE email='$email' LIMIT 1";
                $query_run = mysqli_query($connection, $query);
                $check_email = mysqli_fetch_all($query_run);

                if($check_email == NULL) {

                    $error = "Nenhuma conta associada ao email introduzido";

                } else {

                    sendEmail($connection,$email,"recover_password");
                    header("Location: recover_password.php?fase=submit_code");
                    die();

                }

            }

        break;
        case "submit_code":

            if(!isset($_SESSION['recover']['email'])) {

                unset($_SESSION['recover']);
                header("Location: recover_password.php");
                die();

            } else {

                $code = $_POST['code'];

                if(!preg_match("/^[0-9]{6}$/",$code)) { /**verificação dos caracteres introduzidos para serem apenas 6 números que vão de 0 a 9 */

                    $error = "Código incorreto";

                }

                if($error == "") {

                    $verification = checkCode($connection,$code,$_SESSION['recover']['email']);

                    if($verification == "Código correto") {

                        $_SESSION['recover']['code'] = $code;
                        header("Location: recover_password.php?fase=redo_password");
                        die();

                    } else {

                        $error = $verification;

                    }

                } 

            }

        break;
        case "redo_password":

            if(!isset($_SESSION['recover']['email']) || !isset($_SESSION['recover']['code'])) {
                
                unset($_SESSION['recover']);
                header("Location: recover_password.php");
                die();
        
            } else {

                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];

                if($password != $password_confirm) {

                    $error = "As passwords não coincidem";
            
                }

                if(!preg_match("/^[^\'\"]{6,20}$/",$password)) { /**verificação dos caracteres introduzidos para evitar sql injections */
            
                    if(strlen($password)<6 || strlen($password)>20) {
            
                        $error = "A sua password tem de ter entre 6 e 20 caracteres";
            
                    } else { /**aviso do tipo de erro ao introduzir a password */
                        
                        $error = "Introduza uma password válida";
                        
                    }

                }

                if($error == "") {

                    $password_hashed = password_hash($password,PASSWORD_DEFAULT);

                    $recover = recoverPassword($connection,$_SESSION['recover']['email'],$password_hashed);

                    if($recover == false) {

                        $error = "Erro ao recuperar password. Tente novamente";

                    } else {

                        header("Location: recover_password.php?fase=concluido");
                        die();

                    }

                }

            }
            
        break;
        case "concluido":

            unset($_SESSION['recover']);

        break;

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Recuperar Password</title>

    <link rel="stylesheet" href="css/recover_password.css">

    <script>
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

        function togglePassword2() {
            var passwordInput = document.getElementById("passwordInput2");
            var toggleImage = document.getElementById("toggleImage2");

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
        
    switch($fase) {
            
        case "enter_email":
        
    ?>
        <form action="recover_password.php?fase=enter_email" method="POST">
            <h3>Introduza o email para recuperação da password</h3>
            <input type="email" name="email" placeholder="Email" required>
            <p>
                <?php 
                
                    if(isset($error) && $error != NULL) {
                        echo $error;
                    }
                            
                ?>
            </p>  
            <button type="submit">Enviar</button>
            <p>Regressar ao <a href="login.php">Login</a></p>
            <p><a href="recover_password.php">Recomeçar formulário</a></p>
        </form>
    <?php
        
        break;
        case "submit_code":

            if(isset($_SESSION['recover']['email'])) {    
    ?>
        <form action="recover_password.php?fase=submit_code" method="POST">
            <h4>Um código de confirmação foi enviado para o seu email</h4>
            <h3>Introduza o código recebido</h3>
            <input type="text" name="code" placeholder="******" required>
            <p>
                <?php 
                
                    if(isset($error) && $error != NULL) {
                        echo $error;
                    }
                            
                ?>
            </p>  
            <button type="submit">Submeter</button>
            <p>Regressar ao <a href="login.php">Login</a></p>
            <p><a href="recover_password.php">Recomeçar formulário</a></p>
        </form>
    <?php
            } else {

                unset($_SESSION['recover']);
                header("Location: recover_password.php");
                die();

            }

        break;
        case "redo_password":
            
            if(isset($_SESSION['recover']['email']) && isset($_SESSION['recover']['code'])) {
    ?>
        <form action="recover_password.php?fase=redo_password" method="POST">
            <h4>Introduza a nova password</h4>
            <div>
                <input type="password" name="password" placeholder="Password" id="passwordInput" required><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage" onclick="togglePassword()">
                <br>
                <input type="password" name="password_confirm" placeholder="Confirmar Password" id="passwordInput2" required><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage2" onclick="togglePassword2()">
            </div>
            
            <p>
                <?php 
                
                    if(isset($error) && $error != NULL) {
                        echo $error;
                    }
                            
                ?>
            </p>  
            <button type="submit">Submeter</button>
            <p>Regressar ao <a href="login.php">Login</a></p>
            <p><a href="recover_password.php">Recomeçar formulário</a></p>
        </form>
    <?php
            } else {

                unset($_SESSION['recover']);
                header("Location: recover_password.php");
                die();

            }

        break;
        case "concluido":
    ?>

        <form action="recover_password.php?fase=concluido" method="POST">
            <h3>Recuperação da password concluida com susesso!</h3>
            <a href="login.php">
                <input type="button" name="goToLogin" value="Regressar ao login">
            </a>
        </form>

    <?php

        break;

    }
        
    ?>
</body>
</html>