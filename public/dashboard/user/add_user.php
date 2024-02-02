<?php

require_once('../../../private/initialize.php');

use Database\Session;
use App\Role;

$scripts = ['register'];
$page_title = 'Add User';
$roles = Role::all();
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
                <h3 class="text-center mt-2">Add New User</h3>

                <div class="card-body px-5">
                    <form onsubmit="register(event)" method="POST">
                        <div class="mb-3">
                            <input id="name" type="text" class="form-control py-2" placeholder="Your full name" required>
                        </div>

                        <div class="mb-3">
                            <input id="email" type="email" class="form-control py-2" placeholder="Your email" required>
                        </div>

                        <div class="mb-3">
                            <select id="role" class="form-select" required>
                                <option value="" selected>--Select Role--</option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input id="password" type="password" class="form-control py-2" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <input id="confirm_password" type="password" class="form-control py-2" placeholder="Confirm password">
                        </div>
                        <button type="submit" class="btn btn-primary d-block col-5 mx-auto my-3">Add</button>
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
