<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('LAMA', ['edit_profile','common'], []); ?>
<?php draw_header(); ?>


<div class="d-flex align-items-center flex-wrap justify-content-center">
    
    <div class="edit-profile-info d-flex flex-column align-items-center flex-fill">
        
        <h3>Edit Profile</h3>
                
        <img src="../assets/team_photos/vitorhugo.jpg" class="img rounded-circle  " alt="Profile photo">  
                
        <form class="d-flex flex-column align-items-center" method="post" enctype="multipart/form-data">
            <button type="submit" class="btn">Change photo</button>
        </form>


        <!--need to be changed when implementing this feature(this way due to A3)-->
        <textarea rows="5" cols="30" class="mt-3">Hello! My name's Vítor and i am currently taking LBAW's course at FEUP.</textarea>
        <button type="submit" class="mt-1 btn">Update bio</button>
       
                
    </div>


    <div class="form-box d-flex flex-column  align-items-center flex-grow-1">
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


            <div class="changes-buttons text-right mb-3">
                <a href="./profile.php"><button type="submit" class="btn">Discard changes</button></a>
                <button type="submit" class="btn">Save changes</button>
            </div>

        </form>
    </div>
</div>

<?php draw_footer(); ?>
<?php doc_end(); ?>