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

    if(isset($_SESSION['email'])) {
    
        $check_email = $_SESSION['email'];

        $c_query = "SELECT * FROM utilizadores WHERE email = '$check_email' LIMIT 1";
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

?>