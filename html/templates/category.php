<?php function draw_category_card($title, $posts, $activity)
{ ?>
    <div class="col mb-4">
        <article class="card category-card">
            <div class="card-body">
                <header class="d-flex flex-row justify-content-between">
                    <h5 class="card-title">! <?= $title ?></h5>
                    <aside>
                        <i class="fas fa-pen"></i>
                        <i class="far fa-star"></i>
                    </aside>
                </header>
            </div>
            <footer class="row justify-content-between card-footer">
                <p class="col-12 col-xl-6"><?= $posts ?> posts</p>
                <p class="col-12 col-xl-6">Last active: <?= $activity ?></p>
            </footer>
        </article>
    </div>
<?php } ?>