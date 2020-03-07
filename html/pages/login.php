<?php

include_once(__DIR__.'/../templates/common.php');

?>

<?php doc_start('LAMA', ['login'], []); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 form-container">

            <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
              
                <div class="logo mt-5 mb-3">
                    <a href="./home.php"><img src="../assets/lama_logo.svg" width="140px"></a>
                </div>

                <div class="heading mb-3">
                    <h4>Login into your account</h4>
                </div>

                <form>
                    <div class="form-input">
                      <span> <i class="fa fa-user"></i></span>
                      <input type="text" placeholder="Username" required>
                    </div>

                    <div class="form-input">
                        <span> <i class="fa fa-lock"></i></span>
                        <input type="password" placeholder="Password" required>
                    </div>

                    <div class="row mb-3">
                      <div class="col-6 d-flex">        
                      </div>
                      <div class="col-6 text-right">
                        <a href="#" class="forget-link">Forgot password</a>
                      </div>
                    </div>

                    <div class="text-center mb-3">
                      <button type="submit" class="btn">Log in</button>
                    </div>

                    <h6><span> or login with </span></h6>
                
                    <div class="google mb-3">

                        <a href="" class="btn btn-block btn-social btn-google">Google</a>

                    </div>

                    <div class="register-account">
                      Don't have an account?
                      <a href="./register.php" class="register-link"> Register here.</a>
                    </div>

                </form>

            </div>
        </div>

        <div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>

    </div>
</div>

<?php doc_end(); ?>