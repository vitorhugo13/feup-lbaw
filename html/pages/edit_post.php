<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');
include_once(__DIR__.'/../templates/report_elems.php');

?>

<?php doc_start('Edit Post', ['common', 'post_elems', 'edit_post'], ['top', 'textarea']); ?>
<?php draw_header(); ?>

<form class="d-flex flex-row">
    <div id="sidebar">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <div class="align-items-left"> <p class="nav-title">Post Categories</p></div>
            <div class="opt">
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
            <div class="selected-categories">
                <?php draw_category_move_badge('Politics'); ?>
                <?php draw_category_move_badge('Gaming'); ?>
                <?php draw_category_move_badge('Ethics'); ?>
            </div>
            </div>
        </div>  
    </div>

    <div id="main">
        <div class="d-flex flex-column justify-content-stretch">
        <input type="text" id="post-title" placeholder="Title"/>
        <textarea id="post-body" placeholder="What is this post about?" oninput="auto_grow(this)"></textarea>
        <div id="post-buttons" class="d-flex flex-row justify-content-end">
            <button class="btn btn-secondary">Cancel</button>
            <button class="btn btn-primary" type="submit">Post</button>
        </div>  
        </div>  
    </div>

    </div>
</form>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>
