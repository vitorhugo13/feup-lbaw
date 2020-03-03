<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('EDIT PROFILE', ['edit_profile','common'], []); ?>
<?php draw_header(); ?>


<div class="container-fluid d-flex  align-items-center flex-wrap justify-content-center mb-3 mt-5">

    <div class="md-3 mt-5 d-flex flex-column justify-content-between align-items-center flex-grow-1 p-2 flex-fill">

        <h1>Edit Profile</h1>
                
        <img src="../assets/team_photos/vitorhugo.jpg" class="img rounded-circle  mt-2" alt="Profile photo">  
                
        <form class="d-flex flex-column align-items-center" method="post" enctype="multipart/form-data">
            <button type="submit" class="btn photo-btn">Change photo</button>
        </form>

        <div class="form-input md-3 mt-3">
            <form>
                <textarea class="md-3" rows="5" cols="30" > Hello! My name's Vítor and i am currently taking LBAW's course at FEUP.</textarea>
                <div class="text-center mb-3">
                     <button type="submit" class="btn">Update bio</button>
                </div>
            </form>
        </div>
                
    </div>


    <div class="form-box md-3 mt-5 d-flex flex-column justify-content-between align-items-center  flex-grow-1">

        <div class="logo mt-5 mb-3">
            <a href="home.html"><img src="../assets/lbaw.png" width="150px"></a>
        </div>

        <form> 
            <div class="form-input">
                <span> <i class="fa fa-user"></i></span>
                <input type="text"  value="vitorhugo_5">
            </div>

            <div class="form-input">
                <span> <i class="fa fa-envelope"></i></span>
                <input type="text" value="vhlg@gmail.com">
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="Old Password" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="New Password" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="Repeat New Password" required>
            </div>


            <div class="text-center mb-3">
                <button type="submit" class="btn">Save changes</button>
            </div>
        </form>
    </div>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>