<?php

require "../priv/fileload.php";

/**alterações na tabela de utilizadores -atualizar-eliminar- */

if(isset($_POST['edit_user'])) {

    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);

    $cargo = mysqli_real_escape_string($connection, $_POST['cargo']);
        
    $query = "UPDATE utilizadores SET cargo='$cargo' WHERE email='$user_email' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['message'] = "Utilizador atualizado com sucesso";
        header("Location: users_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Utilizador não atualizado";
        header("Location: users_view.php");
        exit(0);

    }

}

if(isset($_POST['delete_user'])) {
    
    $user_email = mysqli_real_escape_string($connection, $_POST['delete_user']);

    $query = "DELETE FROM utilizadores WHERE email='$user_email'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['message'] = "Utilizador apagado com sucesso";
        header("Location: users_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Utilizador não apagado";
        header("Location: users_view.php");
        exit(0);

    }

}

/**atualizações na tabela das mensagens, -marcarrespondida-eliminar- */

if(isset($_POST['mark_mensagem'])) {

    $msg_id = mysqli_real_escape_string($connection, $_POST['mark_mensagem']);

    $query = "UPDATE mensagens SET estado='Respondida' WHERE id='$msg_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['message'] = "Mensagem marcada como respondida";
        header("Location: mensagens_view.php");
        exit(0);
    
    } else {
        
        $_SESSION['message'] = "Ocorreu um erro a marcar mensagem como respondida";
        header("Location: mensagens_view.php");
        exit(0);
    
    }

}

if(isset($_POST['delete_mensagem'])) {
    
    $msg_id = mysqli_real_escape_string($connection, $_POST['delete_mensagem']);

    $query = "DELETE FROM mensagens WHERE id='$msg_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['message'] = "Mensagem apagada com sucesso";
        header("Location: mensagens_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Mensagem não apagada";
        header("Location: mensagens_view.php");
        exit(0);

    }

}

/**atualizações na tabela de stock, -adicionar-atualizar-eliminar- */

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
                    
                        $_SESSION['message'] = "Artigo adicionado com sucesso";
                        header("Location: artigos_view.php");
                        exit(0);
                                
                    } else {
                    
                        $_SESSION['message'] = "Artigo não adicionado";
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

if(isset($_POST['edit_artigo'])) {

    $artigo_id = mysqli_real_escape_string($connection, $_POST['artigo_id']);

    $descricao = mysqli_real_escape_string($connection, $_POST['descricao_artigo']);
    $preco = doubleval(mysqli_real_escape_string($connection, $_POST['preco_artigo']));
    $quantidade = mysqli_real_escape_string($connection, $_POST['quantidade_artigo']);
        
    $query = "UPDATE stock SET preco='$preco', quantidade='$quantidade', descricao='$descricao' WHERE id='$artigo_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['message'] = "Artigo atualizado com sucesso";
        header("Location: artigos_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Artigo não atualizado";
        header("Location: artigos_view.php");
        exit(0);

    }

}

if(isset($_POST['delete_artigo'])) {
    
    $artigo_id = mysqli_real_escape_string($connection, $_POST['delete_artigo']);

    $query = "DELETE FROM stock WHERE id='$artigo_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run) {

        $_SESSION['message'] = "Artigo apagado com sucesso";
        header("Location: artigos_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Artigo não apagado";
        header("Location: artigos_view.php");
        exit(0);

    }

}

?>