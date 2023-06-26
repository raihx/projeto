<?php

require "../priv/fileload.php";

$error = ""; /**variável usada para emitir os erros ao utilizador, posteriormente modificada consoante os mesmos */
$reg_email = "";
$reg_username = "";
$reg_telemovel = "";
$reg_password = "";

if($_SERVER['REQUEST_METHOD'] == "POST") { /**se o servidor receber um dado POST, prossegue com o sign up */

    $reg_email = $_POST['email'];
    $reg_username = $_POST['username'];
    $reg_password = $_POST['password'];
    $reg_pass_conf = $_POST['password_confirm'];
    $reg_telemovel = $_POST['telemovel'];

    if($reg_password != $reg_pass_conf) {

        $error = "As passwords não coincidem";

    }


    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$reg_email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
        $error = "Formato de email inválido";
    
    }

    if(!preg_match("/^[A-Z a-z À-Ö Ø-ö ø-ÿ]+$/",$reg_username)) { /**verificação dos caracteres introduzidos no campo nome, permitindo todas as letras e acentuações no alfabeto inglês */
        
        $error = "Introduza um nome com caracteres adequados";     
    
    }

    if(!preg_match("/^[^\'\"]{6,20}$/",$reg_password)) { /**verificação dos caracteres introduzidos para evitar sql injections */
        
        if(strlen($reg_password)<6 || strlen($reg_password)>20) {

            $error = "A sua password tem de ter entre 6 e 20 caracteres";

        } else { /**aviso do tipo de erro ao introduzir a password */
            
            $error = "Introduza uma password válida";
            
        }
    }


    if(!preg_match("/^[0-9]{9}$/",$reg_telemovel)) { /**verificação dos caracteres introduzidos para serem apenas números de 0 a 9 */

        $error = "Formato de número de telemóvel inválido";
    
    }
    
    /**este bloco verifica se existe algum caracter indevido e se sim atribuir à variável o respetivo erro */

    $v_query = "SELECT * FROM utilizadores WHERE email = '$reg_email' LIMIT 1";
    $result = mysqli_query($connection,$v_query);

    if($result) {

        $ver = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if(is_array($ver) && !empty($ver)) {

            $error = "Este email já possui uma conta associada";

        }

    }

    /**este bloco confirma se já existe uma conta criada com o email introduzido */

    if($error == "") { /**se a variável $error estiver vazia significa que tudo correu como esperado, prosseguindo assim com o sign up */

        $i_email = $reg_email;
        $i_username = $reg_username;
        $i_password = password_hash($reg_password, PASSWORD_DEFAULT); /**método que ecripta a password */
        $i_telemovel = $reg_telemovel;
    
        $i_query = "INSERT INTO utilizadores(email, nome_utilizador, password, telemovel) VALUES ('$i_email','$i_username','$i_password','$i_telemovel')";
        mysqli_query($connection,$i_query);
    
        header('Location: login.php');
        die;
    
    }
    
    /**este bloco introduz os dados do novo utilizador criado */
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/signup.css">

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
    
    <title>Registo</title> 
</head>
<body>
    <div class="body">
        <div class="blue">

        </div>

        <div class="formSignup">
            <h1>Sign Up</h1>
            <form action="" method="POST">    
                <fieldset>
                    <h3>Email</h3>
                    <br>
                    <input type="email" name="email" value="<?= $reg_email ?>" required>
                </fieldset>
                <fieldset>
                    <h3>Nome</h3>
                    <br>
                    <input type="text" name="username" value="<?= $reg_username ?>" required>
                </fieldset>
                <div class="Pass">
                    <fieldset>
                        <h3>Password</h3>
                        <br>
                        <input type="password" name="password" id="passwordInput" value="<?= $reg_password ?>" required><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage" onclick="togglePassword()">
                    </fieldset>
                    <fieldset>
                        <h3>Confirmação de password</h3>
                        <br>
                        <input type="password"  name="password_confirm" id="passwordInput2" required><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage2" onclick="togglePassword2()">
                    </fieldset>
                </div>
                <fieldset>
                    <h3>Telemóvel</h3>
                    <br>
                    <input type="text" placeholder="Telemóvel" name="telemovel" value="<?= $reg_telemovel ?>" required>
                </fieldset>

                <div class="erro">
                    <?php   

                        if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */
                            echo $error;
                        }

                    ?>
                </div>

                <fieldset class="buttonLogin">
                    <button type="submit">Sign Up</button>
                </fieldset>

                <fieldset class="link">
                    <p>Ir para <a href="login.php">Login</a>.</p>
                </fieldset>
            </form>
        </div>

        <div class="blue">

        </div>
        
    </div>
</body>
</html>