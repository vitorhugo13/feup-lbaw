<?php

include_once('../templates/common.php');
include_once('../templates/posts.php');

?>

<?php doc_start('Post', ['common', 'post'], []); ?>
<?php draw_header(); ?>

        <div class="post">
            <header class="d-flex flex-column">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <div>    
                        <img class="rounded-circle" src="../assets/user.jpg" width="50">
                        <a href="#">lamao</a>
                        <span>&middot;</span>
                        <span>17h ago</span>
                    </div>
                    <div class="d-flex flex-row">
                        <i class="far fa-star mr-3"></i>
                        <div class="dropdown">
                            <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Report</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Mute</a>
                                <a class="dropdown-item" href="#">Move</a>
                                <a class="dropdown-item" href="#">Block User</a>
                                <a class="dropdown-item" href="#">Resolve</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h1>Title title</h1>
                <div>
                    Ethics Politics
                </div>
            </header>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam in tellus sit amet euismod. Ut at mi id nunc ultrices tincidunt sit amet in nisl. Nunc consectetur diam sed purus commodo, eu malesuada nisl dapibus. Vestibulum id urna tincidunt, accumsan felis sit amet, aliquam metus. Vivamus auctor metus quis felis rhoncus, eget hendrerit massa vulputate. In hac habitasse platea dictumst. Praesent sed purus interdum, semper nibh in, feugiat odio. Donec quis lobortis quam, a aliquet ante. Etiam est nisi, accumsan non mi sit amet, viverra ornare dui. Suspendisse tincidunt venenatis nulla, non aliquet augue. Sed lobortis a quam at faucibus. Morbi euismod ipsum eget condimentum convallis. Quisque ultrices varius magna, sed congue eros rutrum eu. Praesent mauris eros, placerat sit amet venenatis et, vehicula sit amet augue.</p>
                <p>Nunc commodo purus malesuada auctor efficitur. Aenean libero risus, semper sed fermentum at, suscipit eu ligula. Cras bibendum est at lorem congue, vel dignissim diam convallis. Mauris id nunc fringilla, mollis mauris in, congue orci. Maecenas condimentum fringilla orci, eget tempor velit ultricies non. Sed lacinia lacus sit amet dui elementum, eu vehicula tellus fermentum. Cras eget vehicula tellus. Morbi leo elit, mollis et suscipit id, malesuada non neque. Ut gravida mauris leo, nec dictum libero consectetur nec. Etiam ante diam, posuere in elementum tempor, hendrerit at leo. Aenean porttitor porttitor ex, consectetur sollicitudin ligula elementum eget. Vestibulum sit amet nunc sed justo pharetra tristique. Pellentesque magna lacus, sagittis ut pellentesque non, venenatis nec eros.</p>
            </div>
            <footer class="d-flex flex-row align-items-center">
                <div class="upvotes"><i class="far fa-thumbs-up"></i>2k</div>
                <div class="downvotes"><i class="far fa-thumbs-down"></i>407</div>
            </footer>
        </div>
        <div class="comment-section">
            <header><span>Comments</span><span>&middot;</span><span>1230</span></header>
            <form>
                <textarea placeholder="Leave a comment!"></textarea>
                <button type="submit"><i class="far fa-paper-plane"></i></button>
            </form>
            <?php draw_comment('lama', '17h ago', 'this is a comment', '10k', '2', '30', 0); ?>
            <?php draw_comment('lama', '17h ago', 'this is a comment', '10k', '2', '30', 1); ?>
            <?php draw_comment('lama', '17h ago', 'this is a comment', '10k', '2', '30', 0); ?>
        </div>

<?php draw_footer(); ?>
<?php doc_end(); ?>