<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');

?>

<?php doc_start('PROFILE', ['profile','common','post_elems'], []); ?>
<?php draw_header(); ?>

<div class="profile-container">
    <div class="row">
        <div class="info-card col-test col-12 col-lg-3 d-flex flex-column align-items-center"> 
            <img src="../assets/team_photos/vitorhugo.jpg" class="img rounded-circle  mt-2" alt="Profile photo">
            <div class="username d-flex flex-row align-items-center">
                <p>vitorhugo_5</p>
                <div class="dropdown col-1">        
                <div  data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../pages/profile.php">Promote</a>
                        <a class="dropdown-item" href="#">Demote</a>
                        <a class="dropdown-item" href="#">Report</a>
                        <a class="dropdown-item" href="#">Block</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap flex-column">
                <p class="bio text-left">
                    Adoro desporto e economia. Sou uma pessoa bastante respeitadora, portanto também exigo que o sejam comigo. Abraço! 
                </p>
            </div>

            <div class="d-flex flex-column align-items-center">
                <a class="edit-button" href="./edit_profile.php"></i><strong>Edit profile</strong></a>
            </div>
        </div> 

        <div class="side-info col-12 col-md-5 col-lg-4"> 
            <img src="../assets/gold_llama.svg"  width="80" alt="photo">
            <div class="points"> <p>&diams; 12903 points &diams;</p></div>
            <div class="blocked">
                <div class="blocked-text">
                    <p>You are blocked for:</p>
                </div>
                <div class="remaining-time">
                    <p>49h 30m 06s</p>
                </div>
                <button class="contest-button"><i class="fas fa-exclamation-circle"></i><strong>  Contest</strong></button>
            </div>
        </div>

        <div class="col-12 col-md-7 col-lg-5 top_categories">
            <div class="">
                <div class="categories-text">
                    <h4>Top Categories</h4>
                </div>
                <div class="list-top">
                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> ! Sports</span>
                        <span>8567</span>
                    </div>

                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> ! Economy</span>
                        <span>2103</span>
                    </div>

                    <div class="top_category d-flex justify-content-between">
                        <span><i class="fas fa-medal"></i> ! Literature</span>
                        <span>783</span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="post-section row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-9"> 

            <div class="number-posts align-baseline"> <strong>Posts </strong> (19)</div>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '50k', '360', '1230'); ?>
            </div>
    </div>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>