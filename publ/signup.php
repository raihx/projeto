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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
    rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" 
    crossorigin="anonymous">
    <script>
        function ver_pass(){
            var x = document.getElementById("passwordid");
            var y = document.getElementById("hide");
            var z = document.getElementById("hide1");

            if(x.type === "password"){
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }
    
        function ver_conf_pass(){
            var x = document.getElementById("passwordid1");
            var y = document.getElementById("hide2");
            var z = document.getElementById("hide3");

            if(x.type === "password"){
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
            }
        }
    </script>
    <title>Registo</title> 
</head>
<body>

    <div class="formulario">
    <form action="" method="POST" autocomplete="off">    
        <h1>Sign Up</h1>

        <div class="input-box">
            <i class="fa fa-envelope-o"></i>
            <input type="email" placeholder="Email" name="email" value="<?php echo $reg_email ?>" required>
        </div>

        <div class="input-box">
            <i class="fa fa-user"></i>
            <input placeholder="Nome de utilizador" name="username" value="<?php echo $reg_username ?>" required>
        </div>

        <div class="input-box">
            <i class="fa fa-key"></i>
            <input type="password" placeholder="Password" id="passwordid" name="password" value="<?php echo $reg_password ?>" required>
            <span class="eye" onclick="ver_pass()"><i id="hide" class="fa fa-eye"></i><i id="hide1" class="fa fa-eye-slash"></i> 
        </div>

        <div class="input-box">
            <i class="fa fa-key"></i>
            <input type="password" placeholder="Confirmar Password" id="passwordid1" name="password_confirm" required>
            <span class="eye" onclick="ver_conf_pass()"><i id="hide2" class="fa fa-eye"></i><i id="hide3" class="fa fa-eye-slash"></i>
        </div>
            </span>

        <div class="input-box">
            <i class="fa fa-phone"></i>
            <input type="text" placeholder="Telemóvel" name="telemovel" value="<?php echo $reg_telemovel ?>" required>
        </div>
        
        <div>
            <button type="submit" class="botaologin">Sign Up</button>
        </div>

        <div class="error">
            <?php   

                if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */
                    echo $error;
                }

            ?>
        </div>
    </form>
    </div>
</body>
</html>