<?php

require "../priv/fileload.php";

$error = ""; /**variável usada para emitir os erros ao utilizador, posteriormente modificada consoante os mesmos */
$reg_email = "";
$reg_username = "";
$reg_telemovel = "";

if($_SERVER['REQUEST_METHOD'] == "POST") { /**se o servidor receber um dado POST, prossegue com o sign up */

    $reg_email = $_POST['email'];
    $reg_username = $_POST['username'];
    $reg_password = $_POST['password'];
    $reg_telemovel = $_POST['telemovel'];

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

        $ver_email = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if(is_array($ver_email) && !empty($ver_email)) {

            $error = "Este email já possui uma conta associada";

        }

    }

    if($error == "") { /**se a variável $error estiver vazia significa que tudo correu como esperado, prosseguindo assim com o sign up */

        $i_email = $reg_email;
        $i_username = $reg_username;
        $i_password = password_hash($reg_password, PASSWORD_DEFAULT); /**método que ecripta a password */
        $i_telemovel = $reg_telemovel;
    
        $r_query = "INSERT INTO utilizadores(email, nome_utilizador, password, telemovel) VALUES ('$i_email','$i_username','$i_password','$i_telemovel')";
        mysqli_query($connection,$r_query);
    
        header('Location: login.php'); /**apenas depois de inserir os dados do novo utilizador redireciona para a página do login */
        die;
    
    }

    /**este bloco executa a query pelo meio de um statement pre-preparado, de maneira a evitar sql injections */
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
    <form action="" method="post">
        email:<input type="text" name="email" value="<?php echo $reg_email ?>" required><br><br>
        nome:<input type="text" name="username" value="<?php echo $reg_username ?>" required><br><br>
        password:<input type="password" name="password" required><br><br>
        telemovel:<input type="text" name="telemovel" value="<?php echo $reg_telemovel ?>" required><br><br>
        <input type="submit" value="submit">
    </form>
    <br><br>
    
    <?php   

        if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */
            echo $error;
        }

    ?>

</body>
</html>