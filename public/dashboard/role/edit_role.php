<?php

require_once('../../../private/initialize.php');

use App\Role;
use Database\Session;

$scripts = ['role'];
$page_title = 'Edit User Role';

$role = null;
if(isset($_GET['id']) && $_GET['id']>0){
    $role = Role::find($_GET['id']);
    if(!$role){
        Session::setSessionData('error_message', 'Role not found!');
        redirect_to(url_for('dashboard/role/roles.php'));
        die;
    }
}else{
    Session::setSessionData('error_message', 'Role not found!');
    redirect_to(url_for('dashboard/role/roles.php'));
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
                <h3 class="text-center mt-2">Edit User Role</h3>

                <div class="card-body px-5">
                    <form onsubmit="updateRole(event)" method="POST">
                        <div class="mb-3">
                            <input id="name" type="text" class="form-control py-2" placeholder="Your full name" value="<?= $role['name'] ?>" required>
                            <input id="role_id" type="hidden" value="<?= $role['id'] ?>" required>
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
