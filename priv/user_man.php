<?php
require "../priv/fileload.php";

if(isset($_POST['delete_user'])) {
    
    $user_email = mysqli_real_escape_string($connection, $_POST['delete_user']);

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

if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $telemovel = mysqli_real_escape_string($connection, $_POST['telemovel']);
    $cargo = mysqli_real_escape_string($connection, $_POST['cargo']);

    $query = "UPDATE utilizadores SET email='$email', nome_utilizador='$username', telemovel='$telemovel', cargo='$cargo' WHERE email='$user_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Utilizador atualizado com sucesso";
        header("Location: users_view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Utilizador não atualizado";
        header("Location: users_view.php");
        exit(0);
    }

}

?>