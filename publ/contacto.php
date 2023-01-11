<?php

require "../priv/fileload.php";

$login_ver = check_login($connection); /**verificação em todas as páginas que é necessário ter o login para aceder */
$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $msg_email = $_POST['email_msg'];
    $met_resposta = $_POST['met_resposta'];
    $texto_msg = esc($_POST['texto_msg']);

    date_default_timezone_set("Europe/Lisbon");
    $data_msg = date('Y-m-d h:i:s');

    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$msg_email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
        $error = "Formato de email inválido";
    
    }

    /**if(!preg_match("/^[^'\"]$/",$texto_msg)) {

        $error = "Caracteres inválidos na mensagem";

    }*/

    if($error == "") {

        $m_query = "INSERT INTO mensagens(email,metodo_resposta,mensagem,data) VALUE('$msg_email','$met_resposta','$texto_msg','$data_msg')";
        $result = mysqli_query($connection,$m_query);

        if(!$result) {

            $error = "Ocorreu um erro ao enviar a mensagem. Tente novamente.";

        } else {

            header('Location: contacto.php');
            die;

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


    <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
    <script>  
        $(function(){ 
        $("#header").load("header.php");  
        $("#footer").load("footer.php");  
        }); 
    </script>  
</head>
<body>
    <div id="header"></div> 

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
                        <input type="email" name="email_msg" require>
                    </div>
                    <div class="input-box">
                        <label>Escolha o método de resposta:</label>
                        <br>
                        <select type="input" name="met_resposta" id="resposta_met">
                            <option name="resp_email">Email</option>
                            <option name="resp_whatsapp">Whatsapp</option>
                            <option name="resp_chamada">Chamada telefónica</option>
                        </select>
                    </div>
                    <div class="input-box caixatexto">
                        <input type="textarea" name="texto_msg" maxlength="500">
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Enviar"></input>
                    </div>

                    <?php

                        if(isset($error) && $error != "") { /**verifica se a variável erro está preenchida, se sim emite o erro em questão */
                            echo $error;
                        }

                    ?>
                    
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>