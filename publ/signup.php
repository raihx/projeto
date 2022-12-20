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

    $v_arr['reg_email'] = $reg_email;

    $v_query = "SELECT * FROM utilizadores WHERE email = :reg_email LIMIT 1";
    $stm = $connection->prepare($v_query);
    $ver = $stm->execute($v_arr);

    if($ver) {

        $ver_email = $stm->fetchALL(PDO::FETCH_OBJ);

        if(is_array($ver_email) && !empty($ver_email)) {

            $error = "Este email já possui uma conta associada";

        }

    }

    if($error == "") { /**se a variável $error estiver vazia significa que tudo correu como esperado, prosseguindo assim com o sign up */

        $r_arr['reg_email'] = $reg_email;
        $r_arr['reg_username'] = $reg_username;
        $r_arr['reg_password'] = password_hash($reg_password, PASSWORD_DEFAULT); /**método que ecripta a password */
        $r_arr['reg_telemovel'] = $reg_telemovel;
    
        $r_query = "INSERT INTO utilizadores(email, nome_utilizador, password, telemovel) VALUES (:reg_email,:reg_username,:reg_password,:reg_telemovel)";
        $stm = $connection->prepare($r_query);
        $stm->execute($r_arr);
    
        header('Location: login.php'); /**apenas depois de inserir os dados do novo utilizador redireciona para a página do login */
        die;
    
    }

    /**este bloco executa a query pelo meio de um statement pre-preparado, de maneira a evitar sql injections */
    
}

?>


