<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');

?>

<?php doc_start('PROFILE', ['profile','common','post_elems'], []); ?>
<?php draw_header(); ?>

<div class="profile-container">
    <div class="row">
        <div class="col-test col-12 col-lg-3 d-flex flex-column align-items-center"> 
            <img src="../assets/team_photos/vitorhugo.jpg" class="img rounded-circle  mt-2" alt="Profile photo">
            <div class="username d-flex flex-row align-items-center">
                <h3>vitorhugo_5</h3>
                <div class="dropdown col-1">        
                <div  data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../pages/profile.php">Profile</a>
                        <a class="dropdown-item" href="#">Feed</a>
                        <a class="dropdown-item" href="#">Reports</a>
                        <a class="dropdown-item" href="#">Time</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap flex-column">
                <div class=" bio">
                    <i class="fab fa-font-awesome-flag"></i> Adoro desporto e ecónomia. Sou uma pessoa bastante respeitadora, portanto também exigo que o sejam comigo. Abraço! 
                </div>
            </div>

            <div>
                <a class="btn-2" href="./edit_profile.php"><i class="fas fa-pencil-alt"></i><strong>  Edit profile</strong></a>

            </div>
        </div> 

        <div class="col-12 col-md-5 col-lg-4 glory"> 
            <img src="../assets/logo_text.svg"  width="60" alt="photo">
            <div class="points"> <h2>12903 points</h2></div>
            <div class="contest">
                <div class="contest-text">
                    <h4>You are blocked for</h4>
                </div>
                <div class="remaining-time">
                    <h2>49h 30m 06s</h2>
                </div>
                <button class="btn"><i class="fas fa-exclamation-circle"></i><strong>  Contest</strong></button>
            </div>
        </div>

        <div class="col-12 col-md-7 col-lg-5 top_categories">
            <div class="table_categories">
                <div class="categories-text">
                    <h2>Top Categories</h2>
                </div>
                <div class="list-top">
                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> !Sports</span>
                        <span>8k</span>
                    </div>

                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> !Economy</span>
                        <span>2k</span>
                    </div>

                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> !Literature</span>
                        <span>783</span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-9"> 

            <div class="number-posts"> Posts (19)</div>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'username', 'This is the post content preview', '50k', '360', '1230'); ?>
        </div>
    </div>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>