<?php

    if(isset($_SESSION['aviso'])) :

?>

    <div>
        <strong>Atenção!!!</strong> <?= $_SESSION['aviso']; ?>
    </div>

<?php 

    unset($_SESSION['aviso']);
    endif;

?>