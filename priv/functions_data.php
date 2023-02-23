<?php
require "../priv/fileload.php";

if(isset($_POST['delete_user'])) {
    
    $user_email = mysqli_real_escape_string($connection, $_POST['delete_user']);

    $query = "DELETE FROM mensagens WHERE email='$user_email'";
    $exec_delete = mysqli_query($connection,$query);

    if($exec_delete) {

        $query = "DELETE FROM utilizadores WHERE email='$user_email' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run) {

            $_SESSION['message'] = "Utilizador apagado com sucesso";
            header("Location: users_view.php");
            exit(0);

        } else {

            $_SESSION['message'] = "Utilizador não apagado";
            header("Location: index.php");
            exit(0);

        }

    }

}

if(isset($_POST['update_user'])) {

    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);

    $cargo = mysqli_real_escape_string($connection, $_POST['cargo']);
        
    $query_2 = "UPDATE utilizadores SET cargo='$cargo' WHERE email='$user_email' ";
    $query_run = mysqli_query($connection, $query_2);

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

if(isset($_POST['marcar_msg'])) {

    $msg_id = mysqli_real_escape_string($connection, $_POST['marcar_msg']);

    $query = "UPDATE mensagens SET estado='Respondida' WHERE id='$msg_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {

        $_SESSION['message'] = "Mensagem marcada como respondida";
        header("Location: msg_view.php");
        exit(0);
    
    } else {
        
        $_SESSION['message'] = "Ocorreu um erro a marcar mensagem como respondida";
        header("Location: msg_view.php");
        exit(0);
    
    }

}

if(isset($_POST['eliminar_msg'])) {
    
    $msg_id = mysqli_real_escape_string($connection, $_POST['eliminar_msg']);

    $query = "DELETE FROM mensagens WHERE id='$msg_id'";
    $exec_delete = mysqli_query($connection,$query);

    if($exec_delete) {

        $_SESSION['message'] = "Mensagem apagada com sucesso";
        header("Location: msg_view.php");
        exit(0);

    } else {

        $_SESSION['message'] = "Mensagem não apagada";
        header("Location: msg_view.php");
        exit(0);

    }

}

if(isset($_POST['save_artigo'])) {
    
    $nome = mysqli_real_escape_string($connection, $_POST['nome_artigo']);
    $marca = mysqli_real_escape_string($connection, $_POST['marca_artigo']);
    $descricao = mysqli_real_escape_string($connection, $_POST['descricao_artigo']);
    $tipo = mysqli_real_escape_string($connection, $_POST['tipo_artigo']);
    $preco = doubleval(mysqli_real_escape_string($connection, $_POST['preco_artigo']));
    $imagem = mysqli_real_escape_string($connection, $_POST['imagem_artigo']);

    $query = "INSERT INTO stock (nome,marca,descricao,tipo,preco,imagem) VALUES ('$nome','$marca','$descricao','$tipo','$preco','$imagem')";
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

?>