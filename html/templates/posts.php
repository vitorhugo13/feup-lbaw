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

<?php function draw_comment($author, $time, $content, $upvotes, $downvotes, $comments, $level) { ?>
    <div class="comment" style="padding-left: <?=$level * 2?>em;">
        <header class="d-flex flex-row align-items-center justify-content-between">
            <div>
                <span><?=$author?></span>
                <span>&middot;</span>
                <span><?=$time?></span>
            </div>
            <div class="d-flex flex-row">
                <i class="fas fa-reply"></i>
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
        <div class="comment-content">
            <p><?=$content?></p>
        </div>
        <footer class="d-flex flex-row align-items-center justify-content-between">
            <div class="votes d-flex flex-row align-items-center justify-content-between">
                <div class="upvotes "><i class="far fa-thumbs-up"></i><?=$upvotes?></div>
                <div class="downvotes"><i class="far fa-thumbs-down"></i><?=$downvotes?></div>
            </div>
            <div class="comments"><i class="far fa-comment"></i><?=$comments?></div>
        </footer>
    </div>
<?php } ?>
