<?php

    if(isset($_SESSION['aviso'])) :

?>

    <div>
        <strong>Atenção!!!</strong> <?php echo $_SESSION['aviso']; ?>
    </div>

<?php 

    unset($_SESSION['aviso']);
    endif;

?>