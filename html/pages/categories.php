<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/category.php');

?>

<?php doc_start('LAMA TEAM', ['common', 'team', 'categories', 'home'], []); ?>
<?php draw_header(); ?>
<div class="container-fluid">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <ul class="nav flex-column nav-pills text-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#">Name</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Activity</a>
                </li>
            </ul>
            <!-- <section class="btn-group-vertical">
                <button type="button" class="btn btn-outline-light">Name</button>
                <button type="button" class="btn btn-outline-light">Posts</button>
                <button type="button" class="btn btn-outline-light">Activity</button>
            </section> -->
        </div>
        <button><i class="fas fa-plus"></i><strong> New Post</strong></button>
        <button><i class="fas fa-plus"></i><strong> New Category</strong></button>
    </aside>

    <main id="feed">
        <section class="card-deck row row-cols-1 row-cols-lg-2 row-cols-xl-3" id="comm-news">
            <div class="col mb-4 highlight"></div>
            <div class="col mb-4">
                <article class="card category-card">
                    <div class="card-body">
                        <header class="d-flex flex-row justify-content-between">
                            <h5 class="card-title">! Community News</h5>
                            <aside>
                                <i class="fas fa-pen"></i>
                                <i class="far fa-star"></i>
                            </aside>
                        </header>
                    </div>
                    <footer class="d-flex flex-row justify-content-between card-footer">
                        <p>23 posts</p>
                        <p>Last active: 15 days</p>
                    </footer>
                </article>
            </div>
            <div class="col mb-4 highlight"></div>
        </section>

        <section class="card-deck row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <?php draw_category_card('Politics', '125k', '5 min') ?>
            <?php draw_category_card('Gaming', '243k', '30 min') ?>
            <?php draw_category_card('College', '326', '1 day') ?>
            <?php draw_category_card('Bizarre', '1.3M', '2 days') ?>
            <?php draw_category_card('Drunk', '521k', '3 days') ?>
            <?php draw_category_card('Economy', '331k', '12 days') ?>
            <?php draw_category_card('Work', '989', '20 day') ?>
            <?php draw_category_card('Teenager', '473', '2 months') ?>
            <?php draw_category_card('Countries', '10k', '6 months') ?>
            <?php draw_category_card(' Story', '1k', '10 months') ?>
            <?php draw_category_card('Sad Story', '1k', '10 months') ?>
            <?php draw_category_card('Sad Story', '1k', '10 months') ?>
            <?php draw_category_card('Sad Story', '1k', '10 months') ?>
            <?php draw_category_card('Sad Story', '1k', '10 months') ?>
            <?php draw_category_card('Other', '326', '1 year') ?>
        </section>
    </main>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>