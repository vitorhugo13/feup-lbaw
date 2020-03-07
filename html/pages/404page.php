<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('404 Error', ['error_pages','common'], []); ?>
<?php draw_header(); ?>

<div class="error text-center">
    <img src="../assets/sad_llama.svg" width="170px" class="lama-img mt-2" alt="Lama photo">
    <h3 class="error-404">404 Page not found!</h3>
    <p class="error-404-p">The page you are looking for does not exist...</p>
    <a href="./home.php"><button type="submit" class="btn"><i class="fas fa-undo-alt"></i>   Return</button></a>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>