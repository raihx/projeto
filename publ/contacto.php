<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */

$error = "";
$msg_email = "";
$texto_msg = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_utilizador = $_SESSION['id'];
    $msg_email = $_SESSION['email'];
    $met_resposta = $_POST['met_resposta'];
    $texto_msg = esc($_POST['texto_msg']);

    date_default_timezone_set("Europe/Lisbon");
    $data_msg = date('Y-m-d H:i:s');

    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$msg_email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
        $error = "Formato de email inválido";
    
    }

    if($met_resposta == ""){

        $error = "Selecione um método de resposta";

    }

    if($error == "") {

        $m_query = "INSERT INTO mensagens(id_utilizador,email,metodo_resposta,mensagem,data) VALUE('$id_utilizador','$msg_email','$met_resposta','$texto_msg','$data_msg')";
        $result = mysqli_query($connection,$m_query);

        if($result) {

            header('Location: contacto.php');
            $error = "Mensagem enviada com sucesso!";
            die;

        } else {

            $error = "Ocorreu um erro ao enviar a mensagem. Tente novamente.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="css/contacto.css">
    <title>Contacto</title>

</head>
<body>

    <?php

        include('header.php');

    ?>

    <br></br>
    <div class="textContacto">
        <h1>Entre em contacto connosco!</h1>
        <p>Não exite em pedir opiniões e tirar dúvidas sempre que necessário. Respondemos do modo mais conveniente para si o mais rápido possível!</p>
    </div>
    <div class="container">
        <div class="left">
            <img src="../images/message.png">
        </div>
        
        <div class="right">
            <form action="" method="POST" class="form">
                <label>O seu email:</label>
                <br>
                <input type="email" name="email_msg" value="<?= $_SESSION['email']; ?>" class="input-area" disabled>               
                <br>
                <label>Escolha o método de resposta:</label>                    
                <br>
                <select name="met_resposta" class="input-area" required>
                    <option disabled selected value value="">...</option>
                    <option>Email</option>
                    <option>Whatsapp</option>
                    <option>Chamada telefónica</option>
                </select>                
                <br>
                <label>Insira a sua mensagem:</label>
                <br>
                <textarea name="texto_msg" placeholder="Escreva aqui..." maxlength="500" rows="6" value="<?= $texto_msg; ?>" class="input-area" required></textarea>
                <br>
                <input type="submit" name="submit" value="Enviar"></input>
                <div>
                    <?php
                        if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */ 
                            echo $error;
                        }                           
                    ?>
                </div>  
            </form> 
        </div>
                   
    </div>

    <?php

        include('footer.php');

    ?>

</body>
</html>