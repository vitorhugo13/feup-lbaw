<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/category.php');

?>

<?php doc_start('LAMA TEAM', ['common', 'team', 'sidebar', 'categories', 'home'], ['sidebar']); ?>
<?php draw_header(); ?>
<section id="wrapper">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <ul class="nav flex-column nav-pills text-center">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Name</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#">Activity</a>
                </li>
            </ul>
        </div>
        <a href="../pages/edit_post.php"><i class="fas fa-plus"></i><strong> New Post</strong></a>
        <a href="#"><i class="fas fa-plus"></i><strong> New Category</strong></a>
        <div id="side-toggle">
            <i class="fas fa-angle-right active" id="angle-right"></i>
            <i class="fas fa-angle-left" id="angle-left"></i>
        </div>
    </aside>
    <!-- Dark Overlay element -->
    <div class="overlay"></div>

    <main id="feed">
        <section class="card-deck row">
            <div class="col-0 col-md-3"></div>
            <div class="col-12 col-md-6 px-3 px-sm-0 mb-4">
                <article class="card category-card" id="comm-news">
                    <div class="card-body">
                        <header class="d-flex flex-row justify-content-center">
                            <h5 class="card-title">! Community News</h5>
                        </header>
                    </div>
                    <footer class="card-footer">
                        <p>23 posts &middot; Last active: 15 days</p>
                    </footer>
                </article>
            </div>
            <div class="col-0 col-md-3"></div>
        </section>

        <section class="card-deck row row-cols-1 row-cols-md-2">
            <?php draw_category_card('Politics', '125k', '5 min') ?>
            <?php draw_category_card('Gaming', '243k', '30 min') ?>
            <?php draw_category_card('Sports', '1.5M', '12 hours') ?>
            <?php draw_category_card('College', '326', '1 day') ?>
            <?php draw_category_card('Bizarre', '1.3M', '2 days') ?>
            <?php draw_category_card('Drunk', '521k', '3 days') ?>
            <?php draw_category_card('Economy', '331k', '12 days') ?>
            <?php draw_category_card('Job', '989', '20 day') ?>
            <?php draw_category_card('Romance', '179k', '25 days') ?>
            <?php draw_category_card('Teenager', '473', '2 months') ?>
            <?php draw_category_card('Police', '120', '5 months') ?>
            <?php draw_category_card('Countries', '10k', '6 months') ?>
            <?php draw_category_card('Story', '1k', '10 months') ?>
            <?php draw_category_card('Environment', '769', '1 year') ?>
            <?php draw_category_card('Other', '326', '1 year') ?>
        </section>

    </main>
</section>

<?php draw_footer(); ?>
<?php doc_end(); ?>