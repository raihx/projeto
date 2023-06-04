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
if(isset($_POST['edit_user_uti'])) {

    $id_utilizador = mysqli_real_escape_string($connection, $_POST['id_utilizador']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $nome = mysqli_real_escape_string($connection, $_POST['nome_utilizador']);
    $telemovel = mysqli_real_escape_string($connection, $_POST['telemovel']);

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

/* eliminar */
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
            
            $_SESSION['alerta'] = "Item adicionado ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);
            
        } else {

            $_SESSION['alerta'] = "Erro ao adicionar item ao carrinho";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            exit(0);

        }
    
    } else {

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


?>