<?php

require_once('../../private/initialize.php');

use Database\Session;

if (Session::getSessionData('user_logged')) {
    redirect_to(url_for('index.php'));
    die;
}
$scripts = ['login'];
$page_title = 'Login';
?>

<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->

<!-- main content -->
<div class="container pt-sm-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5 col-xl-4">
            <!-- success message goes here -->
            <?php if ($message = Session::getFlashData('success_message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <!-- Error message goes here -->
            <?php if ($message = Session::getFlashData('error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg">
                <div class="border-top border-3 border-primary rounded-top"></div>
                <!-- <i class="d-block fas fa-user-circle text-center text-primary my-3" style="font-size: 80px;"></i> -->
                <h3 class="text-center mt-2">Login Here</h3>

                <div class="card-body px-5">
                    <form onsubmit="logIn(event)" method="POST">
                        <div class="mb-3">
                            <input id="email" type="email" class="form-control py-2" placeholder="Your email">
                        </div>

                        <div class="mb-3">
                            <input id="password" type="password" class="form-control py-2" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary d-block col-5 mx-auto my-3">Login</button>
                    </form>
                </div>
                
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<!-- #####=START FOOTER=##### -->
<?php require_once(SHARED_PATH . '/footer.php'); ?>
<!-- #####=END FOOTER=##### -->
