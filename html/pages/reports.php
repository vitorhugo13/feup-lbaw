<?php

include_once(__DIR__.'/../templates/common.php');
include_once(__DIR__.'/../templates/post_elems.php');
include_once(__DIR__.'/../templates/report_elems.php');

?>

<?php doc_start('Reports', ['common', 'post_elems', 'reports'], ['top']); ?>
<?php draw_header(); ?>

<aside id="sidebar" class="d-flex flex-column align-items-center">
    <header class="align-self-start">Reports</header>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Posts</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Comments</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Contest</a>
    </div>
</aside>



<div id="main">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table>
                <tr>
                    <th>Title</th>
                    <th>Reason</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <?php draw_post_report('Title title', 'Harassement', '20/02/2020'); ?>
                <?php draw_post_report('Title is a pretty big title that deforms the table', 'Harassement', '20/02/2020'); ?>
                <?php draw_post_report('Title title', 'Harassement', '20/02/2020'); ?>
                <?php draw_post_report('Title title', 'Harassement', '20/02/2020'); ?>
                <?php draw_post_report('Title title', 'Harassement', '20/02/2020'); ?>
                <?php draw_post_report('Title title', 'Harassement', '20/02/2020'); ?>
            </table>
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            2
        </div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            3
        </div>
    </div>
</div>

<?php draw_move_modal(); ?>
<?php draw_back_to_top(); ?>

<?php draw_footer(); ?>
<?php doc_end(); ?>
