<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('LAMA TEAM', ['common','team','categories'], []); ?>
<?php draw_header(); ?>
<div class="container">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <section class="btn-group-vertical">
                <button type="button" class="btn btn-outline-success">Name</button>
                <button type="button" class="btn btn-outline-success">Posts</button>
                <button type="button" class="btn btn-outline-success">Activity</button>
            </section>
        </div>
        <button><i class="fas fa-plus"></i><strong>  New Post</strong></button>
        <button><i class="fas fa-plus"></i><strong>  New Category</strong></button>
    </aside>

    <main class="d-flex flex-wrap" id="feed">
        <div class="row">
            <div class="col-lg-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title">!Community News</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title">!College</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <span class="d-flex flex-row">
                            <h5 class="card-title">!World</h5>
                            <span>
                                
                            </span>
                        </span>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>