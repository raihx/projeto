<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */
$error = "";
$msg_email = "";
$texto_msg = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $msg_email = $_POST['email_msg'];
    $met_resposta = $_POST['met_resposta'];
    $texto_msg = esc($_POST['texto_msg']);

    date_default_timezone_set("Europe/Lisbon");
    $data_msg = date('Y-m-d H:i:s');

    $v_query = "SELECT * FROM utilizadores WHERE email='$msg_email'";
    $ver = mysqli_query($connection,$v_query);
    
    if(mysqli_num_rows($ver) == 0) {

        $error = "O email introduzido não possui conta criada.";

    }

    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$msg_email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
        $error = "Formato de email inválido";
    
    }

    if($error == "") {

        $m_query = "INSERT INTO mensagens(email,metodo_resposta,mensagem,data) VALUE('$msg_email','$met_resposta','$texto_msg','$data_msg')";
        $result = mysqli_query($connection,$m_query);

        if($result) {

            header('Location: contacto.php');
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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
    rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contacto.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Contacto</title>

</head>
<body>

    <?php

        include('header.php');

    ?>

    <br></br>
    <div class="background">
    <div class="container">
        <div class="content">
          <div class="quadrado">
            <div class="conteudo">
                <div class="ladoesquerdo">
                    <div class="detalhes do endereço">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <div class="topico"> Endereço </div>
                    <div class="texto1"> Rua ali à esquerda </div>
                    <div class="texto2"> Nº10, 5º andar esquerdo sem elevador </div>
                        </div>

                    <div class="detalhes do telemóvel">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="topico"> Telemóvel </div>
                        <div class="texto1"> +351 931148405 </div>
                        </div>
                    
                    <div class="detalhes do email">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <div class="topico"> Email </div>
                        <div class="texto2"> parcesul@hotmail.com </div>
                        </div>
                </div>


                <div class = "ladodireito">
                    <div class= "topico"> Envia-nos uma mensagem </div>

                <form action="" method="POST">
                    <label>Insira o seu email:</label>
                    <br>
                    <div class="input-box">
                        <input type="email" name="email_msg" value="<?= $msg_email; ?>" required>
                    </div>
                    <div class="input-box">
                        <label>Escolha o método de resposta:</label>
                        <br>
                        <select type="input" name="met_resposta">
                            <option name="resp_email">Email</option>
                            <option name="resp_whatsapp">Whatsapp</option>
                            <option name="resp_chamada">Chamada telefónica</option>
                        </select>
                    </div>
                    <div class="input-box caixatexto">
                        <input type="textarea" name="texto_msg" maxlength="500" value="<?= $texto_msg; ?>" required>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Enviar"></input>
                    </div>
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
    </div>
</div>
</div>
</div>

<?php

    include('footer.php');

?>

</body>
</html>