<?php 

$username = "admin";
$password = "Co6QnzvDtdFkHnRR";
$database = "parcesul";
$host = "localhost";

$con_string = "mysql:host=".$host.";dbname=".$database.""; /**string para fazer uma ligação PDO */

$connection = new PDO($con_string,$username,$password); /**cria a ligação à base de dados */

if(!$connection){ /**verifica se a conexão dá erro */
    
    die("Falha ao conectar à base de dados");
    
}

?>
