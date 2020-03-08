<?php

include_once(__DIR__ . '/../templates/common.php');
include_once(__DIR__ . '/../templates/post_elems.php');
include_once(__DIR__ . '/../templates/report_elems.php');

?>

<?php doc_start('Reports', ['common', 'post_elems', 'reports', 'sidebar'], ['top', 'sidebar']); ?>
<?php draw_header(); ?>

<section class="wrapper">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <ul class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <li class="nav-item">
                    <a class="nav-link active" id="v-pills-posts-tab" data-toggle="pill" href="#posts-tab" role="tab" aria-controls="v-pills-posts" aria-selected="true">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="v-pills-comments-tab" data-toggle="pill" href="#comments-tab" role="tab" aria-controls="v-pills-comments" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="v-pills-contests-tab" data-toggle="pill" href="#contests-tab" role="tab" aria-controls="v-pills-contests" aria-selected="false">Contests</a>
                </li>
            </ul>
        </div>
        <div id="side-toggle">
            <i class="fas fa-angle-right active" id="angle-right"></i>
            <i class="fas fa-angle-left" id="angle-left"></i>
        </div>
    </aside>
    <!-- Dark Overlay element -->
    <div class="overlay"></div>

    <div id="main">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="posts-tab" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php draw_report('I think that using violence in our childrens education is important. AMA.', 'Violence', '07/03/2020'); ?>
                        <?php draw_report('I am the daughter of an influential anti-vaccine figure and was unvaccinated until I got my own shots at 18. AMA!', 'Harassement', '05/03/2020'); ?>
                        <?php draw_report('I hired a black employee and it was the worst decision I made. Does anyone have a solution to the problem?', 'Racism', '03/03/2020'); ?>
                        <?php draw_report('There are several people in my job who are foreigners, and I feel sick to see them here. AMA', 'Xenophobia', '29/02/2020'); ?>
                        <?php draw_report('Hitler is our savior. Ask me anything, I will be happy to explain why.', 'Inappropriate', '27/02/2020'); ?>
                        <?php draw_report('I am terrified of homosexuals, I cannot relate to them. Somebody else?', 'Homophobia', '20/02/2020'); ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="comments-tab" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php draw_report('Same here, that scum should leave our country.', 'Xenophobia', '08/03/2020'); ?>
                        <?php draw_report('ahahah, poor thing, if you were dressed, none of this had happened.', 'Harassement', '06/03/2020'); ?>
                        <?php draw_report('Kim Jong-un and Trump are our only solution', 'Inappropriate', '04/03/2020'); ?>
                        <?php draw_report('The women place is in the kitchen.', 'Sexism', '02/02/2020'); ?>
                        <?php draw_report('Look who he is ...I thought you were at Burger King', 'Bullying', '29/02/2020'); ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contests-tab" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Justification</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php draw_report('You should review my suspension since that was not what I meant. If you notice that comment well, it has a context, but the owner of the main comment edited it.', 'Harassement', '06/03/2020'); ?>
                        <?php draw_report('I was just giving my opinion about black people. I did not insult anyone.', 'Racism', '02/03/2020'); ?>
                        <?php draw_report('Can not I give my opinion on homosexuals? I thought there was still freedom of speech. I did not disrespect anyone', 'Homophobia', '01/03/2020'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php draw_move_modal(); ?>
<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>