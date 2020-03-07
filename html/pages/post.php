<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');

?>

<?php doc_start('Post', ['common', 'post_elems', 'post'], ['top', 'comment']); ?>
<?php draw_header(); ?>

<div class="post">
    <header class="d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <div class="post-user d-flex flex-row align-items-center justify-content-between">    
                <a href="#"><img class="rounded-circle" src="../assets/user.jpg" width="40"></a>
                <a href="#">lamao</a>
                <span>&middot;</span>
                <span>17h ago</span>
            </div>
            <div class="d-flex flex-row align-items-center">
                <i class="far fa-star mr-3"></i>
                <div class="dropdown d-flex align-items-center">
                    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Mute</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#move-modal">Move</a>
                        <a class="dropdown-item" href="#">Block User</a>
                        <a class="dropdown-item" href="#">Resolve</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <h4> I had the greatest job interview in the world, 5000 people applied and I won. I now travel the world and talk about whisky for a living. AMA</h1>
        <div class="post-categories">
            <?php draw_category_badge('Politics'); ?>
            <?php draw_category_badge('Gaming'); ?>
            <?php draw_category_badge('Ethics'); ?>
        </div>
    </header>
    <div class="post-body">
        <p>Last year I applied for a job to become a Global Whisky Ambassador for Grant’s Scotch Whisky. They advertised the role across multiple social media websites so they had a lot of attention from all over the world.</p>
        <p>5000 people applied and I won.</p>
        <p>Past year I have been travelling the world talking about whisky and I have just been nominated as Scotch Whisky Ambassador Of The Year by Icons of Whisky.</p>
        <p>If you want to see some pictures and videos of my journey so far check out my IG @dannydyer</p>
    </div>
    <footer class="d-flex flex-row align-items-center">
    <div class="upvotes"><img src="../assets/hoof_filled.svg" width="13" alt="uphoof"/> 2062</div>
    <div class="downvotes"><img src="../assets/hoof_outline.svg" width="13" alt="downhoof"/>  407</div>
    </footer>
</div>
<div id="comment-section">
    <header><span>Comments</span><span>&middot;</span><span>1230</span></header>
    <?php draw_comment_area(); ?>
    <div id="comments">
        <?php draw_thread(['lama', '17h ago', 'this is a comment', '10k', '2', '30'], [['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2']]); ?>
        <?php draw_thread(['lama', '17h ago', 'this is a comment', '10k', '2', '30'], [['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2']]); ?>
        <?php draw_thread(['lama', '17h ago', 'this is a comment', '10k', '2', '30'], [['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2'], ['lama', '17h ago', 'this is a comment', '10k', '2']]); ?>
    </div>
</div>

<?php draw_move_modal(); ?>
<?php draw_report_modal(); ?>
<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>
