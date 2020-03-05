<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');

?>

<?php doc_start('LAMA', ['common', 'home', 'post_elems'], ['top']); ?>
<?php draw_header(); ?>

<div class="container">
<div id="sidebar" class="d-flex flex-column align-items-center">
    <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
    <div>
        <nav>
            <div class="nav nav-pills" id="pills-tab" role="tablist">
                <a class="nav-item nav-link active" id="fresh-tab" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
                <a class="nav-item nav-link" id="hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
                <a class="nav-item nav-link" id="top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
            </div>
        </nav>
            <div class="tab-categories tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-fresh" role="tabpanel" aria-labelledby="nav-fresh-tab">
                <ul>
                    <li>! Politics</li>
                    <li>! Cars</li>
                    <li>! College</li>
                    <li>! Religion</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                <ul>
                    <li>! Feelings</li>
                    <li>! Cars</li>
                    <li>! Religion</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-top" role="tabpanel" aria-labelledby="nav-top-tab">
                <ul>
                    <li>! College</li>
                    <li>! Teenager</li>
                    <li>! Politics</li>
                    <li>! Cars</li>
                    <li>! Corona Virus</li>
                </ul>
            </div>
            
        </div>
    </div>
    <a id="view-categories" href="./categories.php">View all</a>
    </div>
    <button><i class="fas fa-plus"></i><strong>  New Post</strong></button>
</div>

<div id="feed">
    <?php draw_post_preview('I just got out of prison. Ask me anything.', 'bernas634', 'Donec bibendum sollicitudin semper. Integer et mi eget leo convallis tempor aliquam nec justo. Donec hendrerit ipsum ut neque bibendum, in cursus est tempus. Pellentesque sem erat, consequat cursus nibh sit amet, ultrices ultrices eros. Nam lacinia viverra nisl sit amet porttitor. Nam imperdiet, orci sit amet iaculis facilisis, mi erat molestie justo, a egestas dui velit vel nulla. Quisque commodo erat eget nibh venenatis tincidunt. Integer condimentum mollis nisl consequat accumsan. Curabitur cursus velit lorem, ac mattis est interdum id. Nunc lacinia velit dui, et luctus nulla laoreet ornare.', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
    <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
</div>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>
