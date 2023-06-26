<?php

require "../priv/fileload.php";

/**alterações na tabela de utilizadores */ 
/* atualizar pelo administrador*/
if(isset($_POST['edit_user_adm'])) {

    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
    $cargo = mysqli_real_escape_string($connection, $_POST['cargo']);
        
    $query = "UPDATE utilizadores SET cargo='$cargo' WHERE id_utilizador='$user_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['aviso'] = "Utilizador atualizado com sucesso";
        header("Location: users_view.php");
        exit(0);

    } else {

        $_SESSION['aviso'] = "Utilizador não atualizado";
        header("Location: users_view.php");
        exit(0);

    }

}

/** atualizar pelo utilizador */
/** email, nome e nº */
if(isset($_POST['edit_user_uti'])) {

    $error = "";
    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $nome = mysqli_real_escape_string($connection, $_POST['nome_utilizador']);
    $telemovel = mysqli_real_escape_string($connection, $_POST['telemovel']);

    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$email)) { /**o método preg_match() vai verificar os caracteres introduzidos no campo email*/
        
        $error = $_SESSION['alerta'] = "Formato de email inválido";
        header("Location: ". $_SERVER['HTTP_REFERER']);
        exit(0);
    
    }

    if(!preg_match("/^[A-Z a-z À-Ö Ø-ö ø-ÿ]+$/",$nome)) { /**verificação dos caracteres introduzidos no campo nome, permitindo todas as letras e acentuações no alfabeto inglês */
        
        $error = $_SESSION['alerta'] = "Introduza um nome com caracteres adequados"; 
        header("Location: ". $_SERVER['HTTP_REFERER']);   
        exit(0); 
    
    }

    if(!preg_match("/^[0-9]{9}$/",$telemovel)) { /**verificação dos caracteres introduzidos para serem apenas números de 0 a 9 */

        $error = $_SESSION['alerta'] = "Formato de número de telemóvel inválido";
        header("Location: ". $_SERVER['HTTP_REFERER']);
        exit(0);
    
    }
    
    if($error == "") {

        $query = "SELECT * FROM utilizadores WHERE email='$email'";
        $query_run = mysqli_query($connection, $query);
        $check_email = mysqli_fetch_all($query_run);

        if($check_email != NULL && $check_email == $_SESSION['email']) {
            
            $_SESSION['alerta'] = "O email introduzido já está a ser utilizado";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        } else {
            
            $query = "UPDATE utilizadores SET email='$email', nome_utilizador='$nome', telemovel='$telemovel' WHERE id_utilizador='$id_utilizador' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run) {

                $_SESSION['email'] = $email;
                $_SESSION['username'] = $nome;
                $_SESSION['telemovel'] = $telemovel;
                $_SESSION['alerta'] = "Dados de utilizador atualizados com sucesso";
                header("Location: ". $_SERVER['HTTP_REFERER']);
                exit(0);
                
            } else {

                $_SESSION['alera'] = "Dados de utilizador não atualizados";
                header("Location: ". $_SERVER['HTTP_REFERER']);
                exit(0);

            }

        }
    
    }

}

/** password */
if(isset($_POST['edit_password'])) {

    $error = "";
    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if(!preg_match("/^[^\'\"]{6,20}$/",$password)) { /**verificação dos caracteres introduzidos para evitar sql injections */
        
        if(strlen($password)<6 || strlen($password)>20) {

            $error = $_SESSION['alerta'] = "A sua password tem de ter entre 6 e 20 caracteres";

        } else { /**aviso do tipo de erro ao introduzir a password */
            
            $error = $_SESSION['alerta'] = "Introduza uma password válida";
            
        }
    }
    
    if($error == "") {

        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE utilizadores SET password='$passwordHashed' WHERE id_utilizador='$id_utilizador' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run) {

            $_SESSION['password'] = $password;
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
            
        } else {

            $_SESSION['alera'] = "Dados de utilizador não atualizados";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }
    
    }

}

/** eliminar */
if(isset($_POST['delete_user'])) {
    
    $user_id = mysqli_real_escape_string($connection, $_POST['delete_user']);

    $query = "DELETE FROM utilizadores WHERE id_utilizador='$user_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['aviso'] = "Utilizador apagado com sucesso";
        header("Location: users_view.php");
        exit(0);

    } else {

        $_SESSION['aviso'] = "Utilizador não apagado";
        header("Location: users_view.php");
        exit(0);

    }

}

/** eliminar pelo utilizador */
if(isset($_POST['eliminar_conta'])) {
    
    $user_id = mysqli_real_escape_string($connection, $_POST['eliminar_conta']);

    $query = "DELETE FROM utilizadores WHERE id_utilizador='$user_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['alerta'] = "Conta de utilizador eliminada";
        header("Location: ../publ/login.php");
        exit(0);

    } else {

        $_SESSION['alerta'] = "Conta de utilizador não eliminada";
        header("Location: ../publ/login.php");
        exit(0);

    }

}


/**atualizações na tabela das mensagens */ 
/** marcar respondidas */
if(isset($_POST['mark_mensagem'])) {

    $msg_id = mysqli_real_escape_string($connection, $_POST['mark_mensagem']);

    $query = "UPDATE mensagens SET estado='Respondida' WHERE id_mensagem='$msg_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['aviso'] = "Mensagem marcada como respondida";
        header("Location: mensagens_view.php");
        exit(0);
    
    } else {
        
        $_SESSION['aviso'] = "Ocorreu um erro a marcar mensagem como respondida";
        header("Location: mensagens_view.php");
        exit(0);
    
    }

}

/** eliminar */
if(isset($_POST['delete_mensagem'])) {
    
    $msg_id = mysqli_real_escape_string($connection, $_POST['delete_mensagem']);

    $query = "DELETE FROM mensagens WHERE id_mensagem='$msg_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['aviso'] = "Mensagem apagada com sucesso";
        header("Location: mensagens_view.php");
        exit(0);

    } else {

        $_SESSION['aviso'] = "Mensagem não apagada";
        header("Location: mensagens_view.php");
        exit(0);

    }

}


/**atualizações na tabela de stock */
/** adicionar */
if(isset($_POST['add_artigo']) && isset($_FILES['imagem_artigo'])) {
    
    $nome = mysqli_real_escape_string($connection, $_POST['nome_artigo']);
    $marca = mysqli_real_escape_string($connection, $_POST['marca_artigo']);
    $descricao = mysqli_real_escape_string($connection, $_POST['descricao_artigo']);
    $tipo = mysqli_real_escape_string($connection, $_POST['tipo_artigo']);
    $preco = doubleval(mysqli_real_escape_string($connection, $_POST['preco_artigo']));
    
    $nome_imagem = $_FILES["imagem_artigo"]["name"];
    $size_imagem = $_FILES["imagem_artigo"]["size"];
    $tmp_imagem = $_FILES["imagem_artigo"]["tmp_name"];

    if($_FILES["imagem_artigo"]["error"] === 0) {

		if($size_imagem > 1000000) {

			$_SESSION['erro_imagem'] = "Tamanho de ficheiro não aceite. Tente novamente";
            header('Location: artigo_add.php');

		} else {

			$tipo_imagem = explode('.',$nome_imagem);
			$tipo_imagem = strtolower(end($tipo_imagem));
        
			$tipos_perm = array("jpg", "jpeg", "png"); 

			if(in_array($tipo_imagem, $tipos_perm)) {

				$upload_imagem_nome = uniqid();
				$upload_imagem_nome .= '.'.$tipo_imagem;

                if(move_uploaded_file($tmp_imagem, 'C:/Users/Iconz/Documentos/GitHub/projeto/images/produtos/'.$upload_imagem_nome)) {

                    $query = "INSERT INTO stock (nome,marca,descricao,tipo,preco,imagem) VALUES ('$nome','$marca','$descricao','$tipo','$preco','$upload_imagem_nome')";
                    $query_run = mysqli_query($connection, $query);

                    if($query_run) {
                    
                        $_SESSION['aviso'] = "Artigo adicionado com sucesso";
                        header("Location: artigos_view.php");
                        exit(0);
                                
                    } else {
                    
                        $_SESSION['aviso'] = "Artigo não adicionado";
                        header("Location: artigo_add.php");
                        exit(0);
                                
                    }
                
                }

			} else {

				$_SESSION['erro_imagem'] = "Tipo de ficheiro não permitido";
                header('Location: artigo_add.php');

			}
		
        }

	} else {

		$_SESSION['erro_imagem'] = "Um erro desconhecido aconteceu. Tente novamente";
        header('Location: artigo_add.php');

	}                           

}

/** editar */
if(isset($_POST['edit_artigo'])) {

    $id_artigo = mysqli_real_escape_string($connection, $_POST['id_artigo']);
    $descricao = mysqli_real_escape_string($connection, $_POST['descricao_artigo']);
    $preco = doubleval(mysqli_real_escape_string($connection, $_POST['preco_artigo']));
    $quantidade = mysqli_real_escape_string($connection, $_POST['quantidade_artigo']);
        
    $query = "UPDATE stock SET preco='$preco', quantidade='$quantidade', descricao='$descricao' WHERE id_artigo='$id_artigo' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['aviso'] = "Artigo atualizado com sucesso";
        header("Location: artigos_view.php");
        exit(0);

    } else {

        $_SESSION['aviso'] = "Artigo não atualizado";
        header("Location: artigos_view.php");
        exit(0);

    }

}


/** eliminar */
if(isset($_POST['delete_artigo'])) {
    
    $id_artigo = mysqli_real_escape_string($connection, $_POST['delete_artigo']);

    $query = "DELETE FROM stock WHERE id_artigo='$id_artigo'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['aviso'] = "Artigo apagado com sucesso";
        header("Location: artigos_view.php");
        exit(0);

    } else {

        $_SESSION['aviso'] = "Artigo não apagado";
        header("Location: artigos_view.php");
        exit(0);

    }

}


/** atualizações na tabela carrinho */
/** adicionar */
if(isset($_POST['add_carrinho'])) {

    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $id_artigo = mysqli_real_escape_string($connection, $_POST['id_artigo']);
    $quantidade = mysqli_real_escape_string($connection, $_POST['quantidade']);

    $query = "SELECT * FROM carrinho WHERE id_utilizador='$id_utilizador' AND id_artigo='$id_artigo'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 0) {
        
        $query = "INSERT INTO carrinho(id_utilizador,id_artigo,quantidade) VALUES('$id_utilizador','$id_artigo',$quantidade)";
        $query_run = mysqli_query($connection,$query);

        if($query_run) {
            
            $query = "UPDATE stock SET quantidade=quantidade - '$quantidade' WHERE id_artigo='$id_artigo'";
            mysqli_query($connection,$query);
            $_SESSION['alerta'] = "Item adicionado ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
        
        } else {

            $_SESSION['alerta'] = "Erro ao adicionar item ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }

    } else {

        $query = "UPDATE carrinho SET quantidade=quantidade + '$quantidade' WHERE id_utilizador='$id_utilizador' AND id_artigo='$id_artigo'";
        $query_run = mysqli_query($connection,$query);

        if($query_run) {
            
            $query = "UPDATE stock SET quantidade=quantidade - '$quantidade' WHERE id_artigo='$id_artigo'";
            mysqli_query($connection,$query);
            $_SESSION['alerta'] = "Item adicionado ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
        
        } else {

            $_SESSION['alerta'] = "Erro ao adicionar item ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }

    }

}

/** remover */
if(isset($_POST['remove_carrinho'])) {

    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $id_artigo = mysqli_real_escape_string($connection, $_POST['id_artigo']);
    $quantidade = mysqli_real_escape_string($connection, $_POST['quantidade']);
    
    $query = "SELECT * FROM carrinho WHERE id_utilizador='$id_utilizador' AND id_artigo='$id_artigo'";
    $query_run = mysqli_query($connection,$query);
    $qntCheck= mysqli_fetch_array($query_run);

    if($qntCheck['quantidade'] > 1) {

        $query = "UPDATE carrinho SET quantidade=quantidade - '$quantidade' WHERE id_utilizador='$id_utilizador' AND id_artigo='$id_artigo'";
        $query_run = mysqli_query($connection,$query);

        if($query_run) {
            
            $query = "UPDATE stock SET quantidade=quantidade + '$quantidade' WHERE id_artigo='$id_artigo'";
            mysqli_query($connection,$query);
            $_SESSION['alerta'] = "Item removido do carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
            
        } else {

            $_SESSION['alerta'] = "Erro ao remover item do carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }
    
    } else {

        $query = "DELETE FROM carrinho WHERE id_artigo='$id_artigo' AND id_utilizador='$id_utilizador'";
        $query_run = mysqli_query($connection,$query);

        if($query_run) {
            
            $query = "UPDATE stock SET quantidade=quantidade + '$quantidade' WHERE id_artigo='$id_artigo'";
            mysqli_query($connection,$query);
            $_SESSION['alerta'] = "Item removido do carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
        
        } else {

            $_SESSION['alerta'] = "Erro ao remover item ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }

    }

}

/** eliminar */
if(isset($_POST['eliminar_carrinho'])) {

    $id_artigo = mysqli_real_escape_string($connection, $_POST['id_artigo']);
    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);

    $query = "DELETE FROM carrinho WHERE id_artigo='$id_artigo' AND id_utilizador='$id_utilizador'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {
        
        $_SESSION['alerta'] = "Item removido do carrinho";
        header("Location: ". $_SERVER['HTTP_REFERER']);
        exit(0);
    
    } else {

        $_SESSION['alerta'] = "Erro ao remover item ao carrinho";
        header("Location: ". $_SERVER['HTTP_REFERER']);
        exit(0);

    }

}

/** checkout */
if(isset($_POST['submit_checkout'])) {

    $error = " ";
    $id_utilizador    = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $artigos_compra   = mysqli_real_escape_string($connection, $_POST['artigos_compra']);
    $nome             = mysqli_real_escape_string($connection, $_POST['nome']);
    $apelido          = mysqli_real_escape_string($connection, $_POST['apelido']);
    $email            = mysqli_real_escape_string($connection, $_POST['email']);
    $morada           = mysqli_real_escape_string($connection, $_POST['morada']);
    $distrito         = mysqli_real_escape_string($connection, $_POST['distrito']);
    $codigo_postal    = mysqli_real_escape_string($connection, $_POST['codigo_postal']);
    $telemovel        = mysqli_real_escape_string($connection, $_POST['telemovel']);
    $metodo_pagamento = mysqli_real_escape_string($connection, $_POST['metodo_pagamento']);
    $valor            = mysqli_real_escape_string($connection, $_POST['valor_compra']);   

    date_default_timezone_set("Europe/Lisbon");
    $data = date('Y-m-d H:i:s');

    if(!preg_match("/^[A-Z a-z À-Ö Ø-ö ø-ÿ]+$/",$nome)) {
        
        $error = $_SESSION['alerta'] = "Introduza um nome com caracteres adequados"; 
    
    }

    if(!preg_match("/^[A-Z a-z À-Ö Ø-ö ø-ÿ]+$/",$apelido)) {
        
        $error = $_SESSION['alerta'] = "Introduza um apelido com caracteres adequados"; 
    
    }
    
    if(!preg_match("/^[\w\-\.]+@[\w\-]+\.[\w\-]{2,3}$/",$email)) {
        
        $error = $_SESSION['alerta'] = "Email inválido";
    
    }

    if(!preg_match("/^[A-Z a-z À-Ö Ø-ö ø-ÿ]+$/",$distrito)) {
        
        $error = $_SESSION['alerta'] = "Introduza uma cidade com caracteres adequados"; 
    
    }

    if(!preg_match("/^[0-9]{4}+-[0-9]{3}$/",$codigo_postal)) {
        
        $error = $_SESSION['alerta'] = "Código-postal inválido";
    
    }

    if(!preg_match("/^[0-9]{9}$/",$telemovel)) {

        $error = $_SESSION['alerta'] = "Número de telemóvel inválido";
    
    }

    if($error = " ") {

        $query = "SELECT * FROM utilizadores WHERE id_utilizador='$id_utilizador'";
        $query_run = mysqli_query($connection,$query);

        if($query_run) {

            if($metodo_pagamento == "VISA" || $metodo_pagamento == "Master Card") {

                header("Location: ../publ/checkout.php?cc_method=" . $metodo_pagamento);
                exit(0);

            }

            $query = "INSERT INTO vendas(id_utilizador,nome,apelido,email,morada,distrito,codigo_postal,telemovel,metodo_pagamento,artigos,valor,data)
                      VALUES ('$id_utilizador','$nome','$apelido','$email','$morada','$distrito','$codigo_postal','$telemovel','$metodo_pagamento','$artigos_compra','$valor','$data')";
            $query_run = mysqli_query($connection,$query);

            if($query_run) {

                $query = "DELETE FROM carrinho WHERE id_utilizador='$id_utilizador'";
                mysqli_query($connection,$query);

                header("Location: ../publ/carrinho.php");
                exit(0);

            } else {

                $_SESSION['alerta'] = "Erro ao concluir o checkout Tente novamente mais tarde";
                header("Location: ". $_SERVER['HTTP_REFERER']);
                exit(0);

            }
        
        } else {

            $_SESSION['alerta'] = "Erro ao concluir o checkout Tente novamente mais tarde";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }
    
    } else {

        $_SESSION['alerta'] = "Erro ao concluir o checkout Tente novamente mais tarde";
        header("Location: ". $_SERVER['HTTP_REFERER']);   
        exit(0); 

    }

}

?>