<?php function draw_post_preview($title, $author, $content, $upvotes, $downvotes, $comments) { ?>
    <div class="post-preview">
        <header>
            <div>
                <a class="title" href="#"><?=$title?></a>
                <span class="by">by</span>
                <a class="author" href="#"><?=$author?></a>
            </div>
            <i class="far fa-star"></i>
        </header>
        <div class="content">
            <p><?=$content?></p>
        </div>
        <footer>
            <div class="votes">
                <div class="upvotes"><i class="far fa-thumbs-up"></i><?=$upvotes?></div>
                <div class="downvotes"><i class="far fa-thumbs-down"></i><?=$downvotes?></div>
            </div>
            <div class="comments"><i class="far fa-comment"></i><?=$comments?></div>
        </footer>
    </div>
<?php } ?>

<?php function draw_comment($author, $time, $content, $upvotes, $downvotes, $comments) { ?>
    <div class="comment p-3">
        <header class="d-flex flex-row align-items-center justify-content-between">
            <div>
                <span><?=$author?></span>
                <span>&middot;</span>
                <span><?=$time?></span>
            </div>
            <div class="d-flex flex-row">
                <div class="dropdown">
                    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Report</a>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Mute</a>
                        <a class="dropdown-item" href="#">Block User</a>
                        <a class="dropdown-item" href="#">Resolve</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="comment-body">
            <p><?=$content?></p>
        </div>
        <footer class="d-flex flex-row align-items-center justify-content-between">
            <div class="votes d-flex flex-row align-items-center justify-content-between">
                <div class="upvotes mr-3"><i class="far fa-thumbs-up mr-1"></i><?=$upvotes?></div>
                <div class="downvotes mr-3"><i class="far fa-thumbs-down mr-1"></i><?=$downvotes?></div>
                <?php if ($comments != null) { ?>
                <div class="comments mr-3"><i class="far fa-comment mr-1"></i><?=$comments?></div>
                <?php } ?>
            </div>
            <?php if ($comments != null) { ?>
            <button class="reply-btn d-flex align-items-center"><i class="fas fa-reply mr-1"></i><span>Reply</span></button>
            <?php } ?>
        </footer>
    </div>
<?php } ?>

<?php function draw_thread($comment, $replies) { ?>
    <div class="thread my-4">
        <?php draw_comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4], $comment[5]); ?>

        <div class="replies ml-5">
            <?php foreach ($replies as $reply) {
                draw_comment($reply[0], $reply[1], $reply[2], $reply[3], $reply[4], null);
            } ?>
        </div>
    </div>
<?php } ?>

<?php function draw_comment_area() { ?>
    <div id="comment-area">
        <textarea id="comment-content" placeholder="Leave a comment!" rows="3"></textarea>
        <div class="d-flex flex-row justify-content-end">
            <button id="cancel-btn">Cancel</button>
            <button id="post-btn">Post</button>
        </div>
    </div>
<?php } ?>

<?php function draw_category_badge($name) { ?>
    <a href="#" class="badge badge-pill category-badge">! <?=$name?></a>
<?php } ?>