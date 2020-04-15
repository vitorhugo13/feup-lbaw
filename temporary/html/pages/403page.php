<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('403 Error', ['error_pages','common'], []); ?>
<?php draw_header(); ?>

<div class="error text-center">
    <img src="../assets/suspicious_llama.svg" width="170px" class="lama-img mt-2" alt="Lama photo">
    <h3 class="error-404">403 Access denied!</h3>
    <p class="error-404-p">You don't have permission to open this page...</p>
    <a href="./home.php"><button type="submit" class="btn"><i class="fas fa-undo-alt"></i>   Return</button></a>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>