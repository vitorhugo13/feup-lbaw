<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/post_elems.php');

?>

<?php doc_start('LAMA', ['common', 'home', 'post_elems','search', 'sidebar','feed'], ['top', 'sidebar']); ?>
<?php draw_header(); ?>

<div class="container">
    <div id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <div class="align-items-left"> <p class="nav-title">Stared Categories</p></div>
            <div class="opt">
                <div class="d-flex flex-column align-self-start" id="filters">
                    <div class="form-check">
                        <label class="form-check-label" for="filter-username">
                            <input class="form-check-input" type="checkbox" value="">
                            ! Literature
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="filter-category">
                            <input class="form-check-input" type="checkbox" value="">
                            ! Sports
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="filter-title">
                            <input class="form-check-input" type="checkbox" value="">
                            ! Cinema
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="filter-title">
                            <input class="form-check-input" type="checkbox" value="">
                            ! Politics
                        </label>
                    </div>
                </div>
            </div>
            <a id="view-categories" href="../pages/categories.php">Load more</a>
        </div>
        <a href="./edit_post.php"><i class="fas fa-plus"></i><strong> New Post</strong></a>
        <div id="side-toggle">
            <i class="fas fa-angle-right active" id="angle-right"></i>
            <i class="fas fa-angle-left" id="angle-left"></i>
        </div>
    </div>

    <div id="feed">
        <?php draw_post_preview('11-year-old Syrian table tennis player Hend Zaza qualifies for Olympics', 'titogrine', 'An 11-year-old Syrian table tennis player has qualified for Tokyo 2020 and is set to become one of the youngest Olympians of all time. Prodigy Hend Zaza qualified to play in this summers Games after winning last weeks West Asia Olympic qualification tournament in Jordan. Zaza, who was born in 2009, will become the youngest athlete to compete at this years competition. Ranked 155th in the world, she defeated Lebanons Mariana Sahakian 4-3 in the womens final in Amman. Sahakian is 42 years old, meaning there was a 31-year age gap between the two. ', '50k', '360', '1230'); ?>
        <?php draw_post_preview('I was the director of the film that won the Oscar in 2008', 'cajo_albuquerque', '', '34k', '40', '130'); ?>
        <?php draw_post_preview('I am the daughter of an influential anti-vaccine figure and was unvaccinated until I got my own shots at 18. AMA!', 'bernas670', 'My mother is a huge anti-vaxxer who not only is active in her community but also a prominent figure who pandered to thousands of scared and/or new mothers. She is a part of some of the biggest antivax facebooks groups and runs her own, she has fought against bills and laws and help spread very dangerous misinformation to her almost cult like following.', '5006', '160', '530'); ?>
        <?php draw_post_preview('My hamster will go over my keyboard. Ask it anything.', 'jlopes', 'Its an iPhone keyboard if you were wondering.', '3762', '36', '768'); ?>
        <?php draw_post_preview('I’m going to sleep. AMA so I can wake up with notifications on my phone and feel loved', 'andreia_sousa', '', '492', '30', '690'); ?>
        <?php draw_post_preview('I am a man in my early thirties and I have been with the same woman since I was 13. Ask me anything.', 'joaonmatos', 'Celerabrating our 19th anniversary together this week.', '6922', '36', '556'); ?>
        <?php draw_post_preview('I am an intersex person with XXY chromosomes and parts of both sets of genitals. Ask me anything.', 'turras', '', '1507', '3', '698'); ?>
        <?php draw_post_preview('I am a Korean War veteran. AMA.', 'Specl', 'I was born in 1928, Charleston SC, On January 21. I Joined the United States Marines In 1948. have Two Daughters and One son. I also have two grandsons (One of which is helping me with this AMA). I was deployed in Inchon, South Korea, as reinforcements, trying to pry Seoul from North Korean control (Operation Chromite). I landed on Green beach on the 15th of September, 1950.', '13k', '451', '357'); ?>
        <?php draw_post_preview('I was adopted out of foster care into a financially well off family as a teenager. AMA.', 'heathenborne', 'I basically went from saving my instant ramen broth so I could have “soup” the next day to going on vacations and being able to go to college. I still have some of my poor habits, like hoarding salt packets from takeout and doing a silent prayer every time I buy anything with my card even though I know damn well I have the money for it.', '19k', '276', '155'); ?>
    </div>
    <!-- Dark Overlay element -->
    <div class="overlay"></div>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>