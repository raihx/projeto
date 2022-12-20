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
        
        $error = "Password inadequada";
    
    }

    if($error == "") { /**se a variável $error estiver vazia significa que tudo correu como esperado, prosseguindo assim com o sign up */

        $l_arr['log_email'] = $log_email;
    
        $l_query = "SELECT * FROM utilizadores WHERE email = :log_email LIMIT 1";
        $stm = $connection->prepare($l_query);
        $ver = $stm->execute($l_arr);
        
        if(!$ver) { /**após executar a query verifica se a mesma falhou ou não */

            $error = "Ocorreu um erro ao realizar o login. Tente novamente.";

        } else {

            $userdata = $stm->fetchALL(PDO::FETCH_OBJ); /**lê todos os dados recebidos da query pelo meio de objetos e atribui os mesmos à variável $userdata, tornando-se um array de objetos  */
            
            if(empty($userdata)) { /**aqui é verificado se houve dados devolvidos na consulta */
                
                $error = "Email ou password incorretos";

            } else {

                if(is_array($userdata)) { /**confirma novamente se é um array de objetos e se sim prossegue com o login */
                    
                    foreach($userdata as $userdata) { /**este bloco lê os resultados da query executada, em expecífico o campo do email e da password */
                        
                        $email = $userdata->email;
                        $enc_password = $userdata->password;
                        $username = $userdata->nome_utilizador;
                        $telemovel = $userdata->telemovel;
                        $cargo = $userdata->cargo;  

                    }
                    
                    if(password_verify($log_password,$enc_password)) { /**compara a password introduzida com a ecriptada guardada na BD, através do método password_verify() */

                        $_SESSION['email'] = $email;
                        $_SESSION['username'] = $username;
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

