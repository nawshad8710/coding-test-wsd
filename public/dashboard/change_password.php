<?php

require_once('../../private/initialize.php');

use Database\Session;
use App\User;

$scripts = ['register'];
$page_title = 'Register';

$user = User::findUserByEmail(Session::getSessionData('user_email'));
if(!$user){
    Session::setSessionData('error_message', 'User not found!');
    redirect_to(url_for('dashboard/index.php'));
    die;
}
?>

<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->

<!-- main content -->
<div class="container pt-sm-5 ">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="border-top border-3 border-primary rounded-top"></div>
                <h3 class="text-center mt-2">Change Password</h3>

                <div class="card-body px-5">
                    <form onsubmit="updatePassword(event)" method="POST">
                        <div class="mb-3">
                            <input id="password" type="password" class="form-control py-2" placeholder="Password" required>
                            <input id="user_id" type="hidden" value="<?= $user['id'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <input id="confirm_password" type="password" class="form-control py-2" placeholder="Confirm password">
                        </div>
                        <button type="submit" class="btn btn-primary d-block col-5 mx-auto my-3">Change</button>
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
