<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');

?>

<?php doc_start('LAMA', ['profile','common','post_elems'], ['top']); ?>
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
            <div id="blocked">
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
                        <span><i class="fas fa-medal"></i> ! Music</span>
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
            <div class="number-posts align-baseline"> <strong>Posts </strong> (11)</div>
            <?php draw_post_preview('Manchester United is the best team ever. Prove me otherwise.', 'vitorhugo_5', 'For me, the English team of Macnhester United is the best team ever. Although they are not having a good time, nothing can erase their past. AMA, and I explain the reason.', '5073', '360', '1230'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '49', '1', '2'); ?>
            <?php draw_post_preview('Canceling Olympics would reduce Japans GDP by 1.4%, study says', 'vitorhugo_5', 'If the spread of the new coronavirus forces the cancelation of the Olympics, it will reduce Japan annual gross domestic product by 1.4 percent, a securities firm estimates. In a report Friday, SMBC Nikko Securities Inc. projects the sporting extravaganza will create ¥670 billion ($6.4 billion) in consumer demand and that canceling it will sap about ¥7.8 trillion from GDP.', '39k', '3060', '4330'); ?>            <?php draw_post_preview('VAR, the death of football as we know it.', 'vitorhugo_5', 'Although the VAR came to assist the referees in some decisions, sooner or later it will end the emotion of football. It is impossible for a fan to celebrate a goal knowing that minutes later it can be canceled. NO MODERN FOOTBALL.', '5043', '60', '130'); ?>
            <?php draw_post_preview('I have already been to several music festivals in several countries. Ask me anything', 'vitorhugo_5', 'Music festivals are something that completely cheers me up. Imagine a sunset, with beer and good music ... better than that? complicated. Feel free to ask any questions.', '403', '30', '30'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '129', '13', '10'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '34', '4', '1'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '9', '1', '0'); ?>
            <?php draw_post_preview('Title', 'vitorhugo_5', 'This is the post content preview', '1089', '890', '309'); ?>
        </div>
    </div>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>