<?php function draw_post_preview($title, $author, $content, $upvotes, $downvotes, $comments) { ?>
    <div class="post-preview">
        <header>
            <div>
                <a class="title" href="../pages/post.php"><?=$title?></a>
                <span class="by">
                    by <a class="author" href="../pages/profile.php"><?=$author?></a>
                </span>
            </div>
            <label class="checkbox-label">
                <input type="checkbox" id="star-category">
                <i class="unchecked far fa-star"></i>
                <i class="checked fas fa-star"></i> 
            </label>
        </header>
        <div class="content">
            <p><?=$content?></p>
        </div>
        <footer>
            <div class="votes">
            <div class="upvotes"><img src="../assets/hoof_filled.svg" width="13" alt="uphoof" />+<?=$upvotes?></div>
            <div class="downvotes"><img src="../assets/hoof_outline.svg" width="13" alt="downhoof" />-<?=$downvotes?></div>
            </div>
            <div class="comments"><i class="far fa-comment"></i><?=$comments?></div>
        </footer>
    </div>
<?php } ?>



<?php function draw_comment($author, $time, $content, $upvotes, $downvotes) { ?>
    <div class="comment p-3">
        <header class="d-flex flex-row align-items-center justify-content-between">
            <div class="name-time">
                <span><?=$author?></span>
                <span>&middot; <?=$time?></span>
            </div>
            <div class="d-flex flex-row">
                <div class="dropdown">
                    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
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
                <div class="upvotes mr-3"><img src="../assets/hoof_filled.svg" width="11" alt="downhoof"/></i>+<?=$upvotes?></div>
                <div class="downvotes mr-3"><img src="../assets/hoof_outline.svg" width="11" alt="downhoof"/></i>-<?=$downvotes?></div>
            </div>
            <button class="reply-btn d-flex align-items-center"><span>Reply</span></button>
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
        <textarea id="comment-content" placeholder="Leave a comment!" oninput="auto_grow(this)"></textarea>
        <div class="d-flex flex-row justify-content-end">
            <button id="cancel-btn">Cancel</button>
            <button id="post-btn">Post</button>
        </div>
    </div>
<?php } ?>

<?php function draw_category_badge($name) { ?>
    <a href="#" class="badge badge-pill category-badge">! <?=$name?></a>
<?php } ?>

<?php function draw_category_move_badge($name) { ?>
    <span class="badge badge-pill category-move-badge">! <?=$name?><i class="fas fa-times"></i></span>
<?php } ?>

<?php function draw_report_modal() { ?>
    <div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Report reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="custom-select" id="report-reason">
                        <option selected>Choose...</option>
                        <option value="1">Harassement</option>
                        <option value="2">Wrong category</option>
                        <option value="3">Explicit content</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Report</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function draw_move_modal() { ?>
    <div class="modal fade" id="move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Move</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>