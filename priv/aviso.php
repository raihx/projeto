<?php

    if(isset($_SESSION['aviso'])) :

?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atenção!!!</strong> <?php echo $_SESSION['aviso']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 

    unset($_SESSION['aviso']);
    endif;

?>