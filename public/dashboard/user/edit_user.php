<?php

require_once('../../../private/initialize.php');

use App\User;
use App\Role;
use Database\Session;

$scripts = ['register'];
$page_title = 'Edit User';
$roles = Role::all();

$user = null;
if(isset($_GET['id']) && $_GET['id']>0){
    $user = User::findUser($_GET['id']);
    if(!$user){
        Session::setSessionData('error_message', 'User not found!');
        redirect_to(url_for('dashboard/index.php'));
        die;
    }
}else{
    Session::setSessionData('error_message', 'User not found!');
    redirect_to(url_for('dashboard/index.php'));
    die;
}

?>

<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->

<!-- #####=START Admin nav=##### -->
<?php require_once(SHARED_PATH . '/admin_nav.php'); ?>
<!-- #####=END Admin nav=##### -->

<!-- main content -->
<div class="container pt-sm-5 ">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="border-top border-3 border-primary rounded-top"></div>
                <h3 class="text-center mt-2">Edit User</h3>

                <div class="card-body px-5">
                    <form onsubmit="update(event)" method="POST">
                        <div class="mb-3">
                            <input id="name" type="text" class="form-control py-2" placeholder="Your full name" value="<?= $user['name'] ?>" required>
                            <input id="user_id" type="hidden" value="<?= $user['id'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <input id="email" type="email" class="form-control py-2" placeholder="Your email" value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <select id="role" class="form-select" required>
                                <option value="" selected>--Select Role--</option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id'] ?>" <?= $user['role']==$role['id'] ? 'selected' : '' ?>><?= $role['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary d-block col-5 mx-auto my-3">Update</button>
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
