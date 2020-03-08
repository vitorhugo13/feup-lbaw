<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/post_elems.php');
include_once(__DIR__ . '/../templates/report_elems.php');

?>

<?php doc_start('LAMA', ['common', 'post_elems', 'edit_post'], ['top', 'textarea']); ?>
<?php draw_header(); ?>

<form class="row m-2 m-lg-0">
    <section id="categories-tab" class="col-12 col-lg-3">
        <header>Post Categories</header>
        <div class="input-group">
            <select class="custom-select">
                <option selected>Add new category...</option>
                <option value="1">College</option>
                <option value="2">World</option>
                <option value="3">Economics</option>
                <option value="3">Cinema</option>
                <option value="3">Music</option>
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Add</button>
            </div>
        </div>
        <footer id="selected-categories" class="d-flex flex-column align-items-center">
            <?php draw_category_move_badge('Politics'); ?>
            <?php draw_category_move_badge('Gaming'); ?>
            <?php draw_category_move_badge('Ethics'); ?>
        </footer>
    </section>

    <section id="text-tab" class="col-12 col-lg-8 ml-0 ml-lg-5 mt-5 mt-lg-0">
        <div class="d-flex flex-column justify-content-start align-items-stretch form-group">
            <input type="text" id="post-title" placeholder="Title" />
            <textarea id="post-body" placeholder="What is this post about?"></textarea>
            <div id="post-buttons" class="d-flex flex-row justify-content-end">
                <button class="btn btn-secondary">Cancel</button>
                <button class="btn btn-primary" type="submit">Post</button>
            </div>
        </div>
    </section>
</form>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>