<?php 

$username = "admin";
$password = "Co6QnzvDtdFkHnRR";
$database = "parcesul";
$host = "localhost";

$connection = mysqli_connect($host,$username,$password,$database); /**cria a ligação à base de dados */

if(!$connection){ /**verifica se a conexão dá erro */
    
    die("Falha ao conectar à base de dados");
    
}

?>
