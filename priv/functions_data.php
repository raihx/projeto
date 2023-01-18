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

?>