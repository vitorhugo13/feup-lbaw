<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/posts.php');

?>

<?php doc_start('LAMA', ['common'], ['top']); ?>
<?php draw_header(); ?>

<div id="sidebar" class="d-flex flex-column align-items-center">
    <div>
        <nav>
            <div class="nav nav-pills" id="pills-tab" role="tablist">
                <a class="nav-item nav-link active" id="fresh-tab" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
                <a class="nav-item nav-link" id="hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
                <a class="nav-item nav-link" id="top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-fresh" role="tabpanel" aria-labelledby="nav-fresh-tab">
                <ul>
                    <li>Politics</li>
                    <li>Cars</li>
                    <li>College</li>
                    <li>Religion</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                <ul>
                    <li>Feelings</li>
                    <li>Cars</li>
                    <li>Religion</li>
                    <li>College</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-top" role="tabpanel" aria-labelledby="nav-top-tab">
                <ul>
                    <li>College</li>
                    <li>Teenager</li>
                    <li>Politics</li>
                    <li>Cars</li>
                </ul>
            </div>
        </div>
    </div>
    <button>New Post</button>
</div>

<div id="feed">
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>
