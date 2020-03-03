<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('LAMA TEAM', ['common','team'], []); ?>
<?php draw_header(); ?>

<div>
    <div class="team"><h1> LAMA TEAM</h1></div>

        <div class="container-fluid d-flex align-items-center flex-wrap justify-content-between">

            <div class="name d-flex flex-wrap spacing">
                <img src="../assets/team_photos/bernas.jpeg" class="img" alt="Bernardo's photo">
                <div class="d-flex flex-column text-left">
                    <h2>Bernardo Santos</h2>
                    <div><i class="fas fa-envelope"></i>  up201706534@fe.up.pt </div>
                    <div><i class="fas fa-birthday-cake"></i>  20 years </div>
                    <div><i class="fas fa-thumbtack"></i>  Viseu </div>
                    <div  class="d-flex flex-column" >
                        <div><i class="fas fa-info-circle"></i> Love programming and everything</div>
                        <div class="personal-info-left">related to computers.</div>
                    </div>
                </div>
            </div>
            <div class="name d-flex flex-wrap reverse spacing">
                <div class="d-flex flex-column text-right">
                    <h2>Carlos Jorge</h2>
                    <div> up20170XXXX@fe.up.pt <i class="fas fa-envelope"></i> </div>
                    <div> 21 years <i class="fas fa-birthday-cake"></i></div>
                    <div> Viseu <i class="fas fa-thumbtack"></i></div>
                    <div  class="d-flex flex-column" >
                        <div> Really excited to finish my course <i class="fas fa-info-circle"></i></div>
                        <div class="personal-info-right">and get to work as soon as possible.</div>
                    </div>
                </div>
                <img src="../assets/team_photos/cajo.jpg" class="img" alt="Cajo's photo">
            </div>

        </div>

            

        <div class="container-fluid d-flex  align-items-center flex-wrap justify-content-between">

            <div class="name d-flex flex-wrap spacing">
                <img src="../assets/team_photos/tito.jpg" class="img" alt="Tito's photo">
                <div class="d-flex flex-column text-left">
                    <h2>Tito Griné</h2>
                    <div><i class="fas fa-envelope"></i>  up20170XXXX@fe.up.pt </div>
                    <div><i class="fas fa-birthday-cake"></i>  21 years </div>
                    <div><i class="fas fa-thumbtack"></i>  Viseu </div>
                    <div  class="d-flex flex-column" >
                        <div><i class="fas fa-info-circle"></i> Fascinated by design and</div>
                        <div class="personal-info-left">in love with economics.</div>
                    </div>
                </div> 
            </div> 
            <div class="name d-flex flex-wrap reverse spacing">
                <div class="d-flex flex-column text-right">
                    <h2>Vítor Gonçalves</h2>
                    <div> up20170XXXX@fe.up.pt <i class="fas fa-envelope"></i> </div>
                    <div> 20 years <i class="fas fa-birthday-cake"></i></div>
                    <div> Fafe <i class="fas fa-thumbtack"></i></div>
                    <div  class="d-flex flex-column" >
                        <div> Love sports, particularly football. <i class="fas fa-info-circle"></i></div>
                        <div class="personal-info-right">Delighted by the power of computing.</div>
                    </div>
            </div>
            <img src="../assets/team_photos/vitorhugo.jpg" class="img" alt="Vitor's photo">
        </div>

    </div>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>