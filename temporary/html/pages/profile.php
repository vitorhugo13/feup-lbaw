<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/post_elems.php');

?>

<?php doc_start('LAMA', ['profile', 'common', 'post_elems'], ['top']); ?>
<?php draw_header(); ?>

<section class="row justify-content-center">
    <article class="user-info col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center">
        <img src="../assets/team_photos/vitorhugo.jpg" class="img rounded-circle" alt="Profile photo">
        <div class="username d-flex flex-row align-items-center mt-3">
            <p>vitorhugo_5</p>
            <div class="dropdown col-1">
                <div data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
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
        <p class="bio text-left">Adoro desporto e economia. Sou uma pessoa bastante respeitadora, portanto também exigo que o sejam comigo. Abraço! </p>
        <a class="edit-button" href="./edit_profile.php"><strong>Edit profile</strong></a>
        <div id="blocked" class="mt-5">
            <p class="blocked-text mb-1">You are blocked for:</p>
            <p class="remaining-time">49h 30m 06s</p>
            <button class="contest-button"><i class="fas fa-exclamation-circle"></i><strong> Contest</strong></button>
        </div>
    </article>
    <article class="points-info col-12 col-lg-6 d-flex flex-column justify-content-around align-items-stretch ml-0 ml-lg-4 mt-4 mt-lg-0">
        <div class="glory-points d-flex flex-column justify-content-center align-self-center d-flex flex-column align-items-center">
            <img src="../assets/gold_llama.svg" alt="photo">
            <p>&diams; 12903 points &diams;</p>
        </div>
        <hr>
        <div class="top-categories">
            <h3>Top Categories</h3>
            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Sports</span>
                <span>8567</span>
            </div>

            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Economy</span>
                <span>2103</span>
            </div>

            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Music</span>
                <span>783</span>
            </div>
        </div>
    </article>
</section>

<div class="post-section">
    <p class="number-posts ml-1 mb-2"> <strong>Posts</strong> (9)</p>
    <?php draw_post_preview('Manchester United is the best team ever. Prove me otherwise.', 'vitorhugo_5', 'For me, the English team of Macnhester United is the best team ever. Although they are not having a good time, nothing can erase their past. AMA, and I explain the reason.', '5073', '360', '1230'); ?>
    <?php draw_post_preview('Could some kind soul explain...', 'vitorhugo_5', '...the bond market and the yield curve like Iam 5? It seems that the Fed cuts interest rates, causing the yield to go down, but the price of bonds goes up?', '49', '1', '2'); ?>
    <?php draw_post_preview('Canceling Olympics would reduce Japans GDP by 1.4%, study says', 'vitorhugo_5', 'If the spread of the new coronavirus forces the cancelation of the Olympics, it will reduce Japan annual gross domestic product by 1.4 percent, a securities firm estimates. In a report Friday, SMBC Nikko Securities Inc. projects the sporting extravaganza will create ¥670 billion ($6.4 billion) in consumer demand and that canceling it will sap about ¥7.8 trillion from GDP.', '39k', '3060', '4330'); ?>
    <?php draw_post_preview('VAR, the death of football as we know it.', 'vitorhugo_5', 'Although the VAR came to assist the referees in some decisions, sooner or later it will end the emotion of football. It is impossible for a fan to celebrate a goal knowing that minutes later it can be canceled. NO MODERN FOOTBALL.', '5043', '60', '130'); ?>
    <?php draw_post_preview('I have already been to several music festivals in several countries. Ask me anything', 'vitorhugo_5', 'Music festivals are something that completely cheers me up. Imagine a sunset, with beer and good music ... better than that? complicated. Feel free to ask any questions.', '403', '30', '30'); ?>
    <?php draw_post_preview('Looking for new talents', 'vitorhugo_5', 'I am tired of always listening to the same music. Does anyone have recommendations?', '129', '13', '10'); ?>
    <?php draw_post_preview('The Houston Rockets is just one game above 7th seed Mavericks. If they were to dropped to 7th, the first round match up against Clippers will be amazing.', 'vitorhugo_5', 'Rockets is just 1 game above the 7th seed Mavericks, if they continue to trend down and Mavericks moving up, they can be looking at Clippers as the first round match up. Thoughts?', '34', '4', '1'); ?>
    <?php draw_post_preview('Song for Post Malone "Get Well Post"', 'vitorhugo_5', 'Can we please get this up to the hot topics,I will be making a song for post to show how much we care for him, how much he means to us, how he,he is our insperation,he is our rap God, or beast boxer and most importantly he is our legend. #SavePost', '9', '1', '0'); ?>
    <?php draw_post_preview('Anyone up for a beer in Manchester before the derby?', 'vitorhugo_5', 'I just got on a coach from London. Arriving in Manchester around 12pm and got time until the game to grab a drink. Anyone up for it?', '1089', '890', '309'); ?>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>