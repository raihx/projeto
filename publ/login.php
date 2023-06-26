<?php

require "../priv/fileload.php";

$error = ""; /**variável usada para emitir os erros ao utilizador, posteriormente modificada consoante os mesmos */
$log_email = "";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token']) { /**se o servidor receber um dado POST, prossegue com as verificações do login */

    $log_email = $_POST['email'];
    $log_password = $_POST['password'];


    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$log_email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
            
        $error = "Formato de email inválido";

    }

    if(!preg_match("/^[^\'\"]{6,20}$/",$log_password)) { /**verificação dos caracteres introduzidos para evitar sql injections */
        
        $error = "A password tem de possuir no mínimo 6 caracteres";
    
    }

    if($error == "") { /**se a variável $error estiver vazia significa que tudo correu como esperado, prosseguindo assim com o sign up */
    
        $l_query = "SELECT * FROM utilizadores WHERE email = '$log_email' LIMIT 1";
        $result = mysqli_query($connection,$l_query);
        
        if(!$result) { /**após executar a query verifica se a mesma falhou ou não */

            $error = "Ocorreu um erro ao realizar o login. Tente novamente.";

        } else {

            $userdata = mysqli_fetch_all($result,MYSQLI_ASSOC); /**lê todos os dados recebidos da query e atribui os mesmos à variável $userdata */
            
            if(empty($userdata)) { /**aqui é verificado se houve dados devolvidos na consulta */
                
                $error = "Email ou password incorretos";

            } else {

                if(is_array($userdata)) { /**confirma novamente se é um array e se sim prossegue com o login */
                    
                    foreach($userdata as $userdata) { /**este bloco lê os resultados da query executada, em expecífico o campo do email e da password */
                        
                        $id_user = $userdata['id_utilizador'];
                        $email = $userdata['email'];
                        $enc_password = $userdata['password'];
                        $username = $userdata['nome_utilizador'];
                        $telemovel = $userdata['telemovel'];
                        $cargo = $userdata['cargo'];  

                    }
                    
                    if(password_verify($log_password,$enc_password)) { /**compara a password introduzida com a ecriptada guardada na BD, através do método password_verify() */

                        $_SESSION['id'] = $id_user;
                        $_SESSION['email'] = $email;
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $log_password;
                        $_SESSION['telemovel'] = $telemovel;
                        $_SESSION['cargo'] = $cargo;

                        switch($cargo) {
                            
                            case 'utilizador':
                                header('Location: index.php');
                            break;

                            case 'gestor':
                                header('Location: ../priv/gestorindex.php');
                            break;
                            
                            case 'administrador':
                                header('Location: ../priv/admindex.php');
                            break;
                            
                        }
                    
                    } else {

                        $error = "Email ou password incorretos";

                    }

                }

            }

        }

    }
    
}

$_SESSION['token'] = get_token(30);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/login.css">

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
    </script>
    
    <title>Login</title>
</head>
<body>
    <div class="body">
        <div class="orange">

        </div>
        <div class="formLogin">
            <h1>Login</h1>

            <form action="" method="POST">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <fieldset>
                    <h3>Email</h3>
                    <br>
                    <input type="email" name="email" value="<?= $log_email ?>" required> 
                </fieldset>
                <fieldset>
                    <h3>Password</h3>
                    <br>
                    <div>
                        <input type="password" name="password" id="passwordInput" required><img src="../images/icons/show-icon.png" width="20" height="20" id="toggleImage" onclick="togglePassword()">
                    </div>
                </fieldset>
                <div class="erro">    
                    <?php

                        if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */
                            echo $error;
                        }

                    ?>
                </div>
                <fieldset class="buttonLogin">
                    <button type="submit">Login</button>
                </fieldset>
                
                
                
                <div class="links">
                    <p>Ainda não possui uma conta? <a href="signup.php">Resgiste-se!</a></p>
                    <p>Esqueceu-se da sua password? <a href="recover_password.php">Clique aqui.</a></p>
                </div>
            </form>
        </div>

        <div class="orange">
            
        </div>
    </div>
</body>
</html>