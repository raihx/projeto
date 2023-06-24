<?php

function get_token($length) {

    $characters = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);
    $token = "";

    $length = rand(6, $length);

    for($i = 0; $i < $length; $i++) {

        $rand_char = rand(0, 61);

        $token .= $characters[$rand_char];

    }

    return $token;
    
}

function check_login($connection) { /**esta função vai verificar em todas as páginas se o utilizador está com o login feito */

    if(isset($_SESSION['id'])) {
    
        $check_id = $_SESSION['id'];

        $c_query = "SELECT * FROM utilizadores WHERE id_utilizador = '$check_id' LIMIT 1";
        $result = mysqli_query($connection,$c_query);

        if($result) {

            $userdata = mysqli_fetch_all($result,MYSQLI_ASSOC);

            if(is_array($userdata) && !empty($userdata)) {

                return true;

            }

        }

    }
    
    header('Location: ../publ/login.php');
    die;

}

function esc($text) {

    return addslashes($text);

}

function generateCode() {

    $numbers = array(0,1,2,3,4,5,6,7,8,9);
    $code = "";

    for($i = 0; $i <= 5; $i++) {

        $code .= $numbers[rand(0, 9)];

    }

    return $code;

}

function sendEmail($connection,$email,$source) {

    $expire = time() + (60 + 5);
    $code = generateCode();
    $email = addslashes($email);

    $query = "INSERT INTO codigos_recuperacao(email,codigo,expire) VALUES ('$email','$code','$expire')";
    mysqli_query($connection,$query);

    generateEmail($email,"Recuperação de password",$code,$source);

}

function checkCode($connection,$code,$email) {

    $code = addslashes($code);
    $expire = time();
    $email = addslashes($email);

    $query = "SELECT * FROM codigos_recuperacao WHERE codigo='$code' AND email='$email' ORDER BY id_envio DESC LIMIT 1";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);

    if($result) {

        if(!empty($row)) {

            if($row['expire'] > $expire) {

                return "Código correto";

            } else {

                return "Código expirado";

            }

        } else {

            return "Código incorreto";
        } 

        

    }

    return "Código incorreto";

}

function recoverPassword($connection,$email,$password_hashed) {

    $query = "UPDATE utilizadores SET password='$password_hashed' WHERE email='$email'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        return true;
    
    }

    return false;

}

?>