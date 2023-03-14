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

if(isset($_POST['add_artigo'])) {
    
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

if(isset($_POST['edit_artigo'])) {

    $artigo_id = mysqli_real_escape_string($connection, $_POST['artigo_id']);

    $preco = doubleval(mysqli_real_escape_string($connection, $_POST['preco_artigo']));
        
    $query = "UPDATE stock SET preco='$preco' WHERE id='$artigo_id' ";
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