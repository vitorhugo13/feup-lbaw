<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/post_elems.php');

?>

<?php doc_start('LAMA', ['common', 'home', 'post_elems', 'sidebar'], ['top', 'sidebar', 'filters']); ?>
<?php draw_header(); ?>

<div class="wrapper">
    <div id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <div>
                <nav>
                    <div class="nav nav-pills" id="pills-tab" role="tablist">
                        <a class="nav-item nav-link fresh-tab active" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
                        <a class="nav-item nav-link hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
                        <a class="nav-item nav-link top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
                    </div>
                </nav>
                <div class="tab-categories tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-fresh" role="tabpanel" aria-labelledby="nav-fresh-tab">
                        <ul>
                            <li>! Politics</li>
                            <li>! Cars</li>
                            <li>! College</li>
                            <li>! Religion</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                        <ul>
                            <li>! Feelings</li>
                            <li>! Cars</li>
                            <li>! Religion</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-top" role="tabpanel" aria-labelledby="nav-top-tab">
                        <ul>
                            <li>! College</li>
                            <li>! Teenager</li>
                            <li>! Politics</li>
                            <li>! Cars</li>
                            <li>! Corona Virus</li>
                        </ul>
                    </div>

                </div>
            </div>
            <a id="view-categories" href="../pages/categories.php">View all</a>
        </div>
        <a href="./edit_post.php"><i class="fas fa-plus"></i><strong> New Post</strong></a>
        <div id="side-toggle">
            <i class="fas fa-bars active" id="angle-right"></i>
            <i class="fas fa-bars" id="angle-left"></i>
        </div>
    </div>

    <nav class="filters d-lg-none mb-3 d-flex flex-column align-items-center">
        <div class="nav nav-pills" id="mid-pills-tab" role="tablist">
            <a class="nav-item nav-link fresh-tab active" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
            <a class="nav-item nav-link hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
            <a class="nav-item nav-link top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
        </div>
    </nav>

    <div id="feed">
        <?php draw_post_preview('I just got out of prison. Ask me anything.', 'bernas634', 'I got arrested because I was selling weed in Portugal. Got myself half a year in prison, but it was kida chill really. Now I am back in the streets and keeping myself away from trouble.', '50k', '360', '1230'); ?>
        <?php draw_post_preview('I am a 105-Year-Old Woman. AMA', 'WorldVexillologist', 'For clarification, I am her 2x great-grand nephew who will be answering these questions when Im at her house sometime after January 6th, 2020 (Most likely Jan 11, the dates not final). The answers will be direct quotes from her.', '34k', '40', '130'); ?>
        <?php draw_post_preview('I am the daughter of an influential anti-vaccine figure and was unvaccinated until I got my own shots at 18. AMA!', 'phoriaa', 'My mother is a huge anti-vaxxer who not only is active in her community but also a prominent figure who pandered to thousands of scared and/or new mothers. She is a part of some of the biggest antivax facebooks groups and runs her own, she has fought against bills and laws and help spread very dangerous misinformation to her almost cult like following.', '5006', '160', '530'); ?>
        <?php draw_post_preview('My hamster will go over my keyboard. Ask it anything.', 'un_lucky', 'Its an iPhone keyboard if you were wondering.', '3762', '36', '768'); ?>
        <?php draw_post_preview('I’m going to sleep. AMA so I can wake up with notifications on my phone and feel loved', 'OfficialJuice', '', '492', '30', '690'); ?>
        <?php draw_post_preview('I am a man in my early thirties and I have been with the same woman since I was 13. Ask me anything.', 'Glaurung', 'Celerabrating our 19th anniversary together this week.', '6922', '36', '556'); ?>
        <?php draw_post_preview('I am an intersex person with XXY chromosomes and parts of both sets of genitals. Ask me anything.', 'NecrosisAnon', '', '1507', '3', '698'); ?>
        <?php draw_post_preview('I am a Korean War veteran. AMA.', 'Specl', 'I was born in 1928, Charleston SC, On January 21. I Joined the United States Marines In 1948. have Two Daughters and One son. I also have two grandsons (One of which is helping me with this AMA). I was deployed in Inchon, South Korea, as reinforcements, trying to pry Seoul from North Korean control (Operation Chromite). I landed on Green beach on the 15th of September, 1950.', '13k', '451', '357'); ?>
        <?php draw_post_preview('I was adopted out of foster care into a financially well off family as a teenager. AMA.', 'heathenborne', 'I basically went from saving my instant ramen broth so I could have “soup” the next day to going on vacations and being able to go to college. I still have some of my poor habits, like hoarding salt packets from takeout and doing a silent prayer every time I buy anything with my card even though I know damn well I have the money for it.', '19k', '276', '155'); ?>
    </div>
    <!-- Dark Overlay element -->
    <div class="overlay"></div>
</div>

<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>