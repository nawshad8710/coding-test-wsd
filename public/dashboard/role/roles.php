<?php

require_once('../../../private/initialize.php');

use App\Role;
use App\User;
use Database\Session;

User::authAdmin();
$roles = Role::all();
$count = 1;
$scripts = ['role'];
$page_title = 'User Roles';
$scripts = ['role'];
?>

<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->

<!-- #####=START Admin nav=##### -->
<?php require_once(SHARED_PATH . '/admin_nav.php'); ?>
<!-- #####=END Admin nav=##### -->

<!-- main content -->
<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">All Roles</h1>
            <a type="button" class="btn btn-success mb-3" href="<?= url_for('dashboard/role/add_role.php') ?>">
                New Role <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
            </a>

            <!-- success message goes here -->
            <?php if ($message = Session::getFlashData('success_message')) : ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role) : ?>
                        <tr>
                            <th scope="row"><?= $count++ ?></th>
                            <td><?= $role['name'] ?></td>
                            <td>
                                <a type="button" class="btn btn-info mb-3" href="<?= url_for('dashboard/role/edit_role.php') ?>?id=<?= $role['id'] ?>">
                                    Edit Role <i class="fa fa-pencil ml-2" aria-hidden="true"></i>
                                </a>
                                <button type="button" class="btn btn-danger mb-3" onclick="deleteRole(<?= $role['id'] ?>)">
                                    Delete Role <i class="fa fa-trash ml-2" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- #####=START FOOTER=##### -->
<?php require_once(SHARED_PATH . '/footer.php'); ?>
<!-- #####=END FOOTER=##### -->
