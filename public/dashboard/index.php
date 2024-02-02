<?php

require_once('../../private/initialize.php');

use App\Order;
use App\User;
use Database\Session;

User::authAdmin();
$Users = User::all();
$count = 1;
$page_title = 'Dashboard';
$scripts = ['register'];
?>

<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->

<!-- #####=START Admin nav=##### -->
<?php require_once(SHARED_PATH . '/admin_nav.php'); ?>
<!-- #####=END Admin nav=##### -->

<!-- main content -->
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-5 text-center mb-3">Welcome to the Admin Panel</h1>
            <h3 class="mt-5 text-center">User List</h3>

            <!-- add new user path -->
            <a type="button" class="btn btn-success mb-3" href="<?= url_for('dashboard/user/add_user.php') ?>">
                New User <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
            </a>

            <!-- success message goes here -->
            <?php if ($message = Session::getFlashData('success_message')){ ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= $message ?>
                </div>
            <?php } elseif($message = Session::getFlashData('error_message')){ ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $message ?>
                </div>
            <?php } ?>

            <!-- users data table -->
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Users as $User) : ?>
                        <tr>
                            <th scope="row"><?= $count++ ?></th>
                            <td><?= $User['name'] ?></td>
                            <td><?= $User['email'] ?></td>
                            <td><?= $User['role_name']? $User['role_name']: '' ?></td>
                            <td>
                                <?php if($User['email'] != Session::getSessionData('user_email')){ ?>
                                    <a type="button" class="btn btn-info mb-3" href="<?= url_for('dashboard/user/edit_user.php') ?>?id=<?= $User['id'] ?>">
                                        Edit User <i class="fa fa-pencil ml-2" aria-hidden="true"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger mb-3" onclick="deleteUser(<?= $User['id'] ?>)">
                                        Delete User <i class="fa fa-trash ml-2" aria-hidden="true"></i>
                                    </button>
                                <?php } else{ ?>
                                    <span class="text-success">Current user</span>
                                <?php } ?>
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
