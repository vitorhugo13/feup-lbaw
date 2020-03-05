<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/category.php');

?>

<?php doc_start('LAMA TEAM', ['common', 'team', 'categories'], []); ?>
<?php draw_header(); ?>
<div class="container-fluid">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <section class="btn-group-vertical">
                <button type="button" class="btn btn-outline-success">Name</button>
                <button type="button" class="btn btn-outline-success">Posts</button>
                <button type="button" class="btn btn-outline-success">Activity</button>
            </section>
        </div>
        <button><i class="fas fa-plus"></i><strong> New Post</strong></button>
        <button><i class="fas fa-plus"></i><strong> New Category</strong></button>
    </aside>

    <!-- <main class="d-flex flex-wrap" id="feed"> -->
    <main class="card-deck row row-cols-1 row-cols-lg-2 row-cols-xl-3" id="feed">
        <div class="col mb-4">
            <article class="card category-card" id="comm-news">
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
                    <p><?= $posts ?> posts</p>
                    <p>Last active: <?= $activity ?></p>
                </footer>
            </article>
        </div>
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
    </main>
    <!-- </main> -->
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>