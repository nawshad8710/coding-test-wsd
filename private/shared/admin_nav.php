<?php

use Database\Session;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Coding Task</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $page_title === 'Home' ? 'active' : '' ?>" aria-current="page" href="<?= url_for('index.php') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_title === 'Dashboard' ? 'active' : '' ?>" aria-current="page" href="<?= url_for('dashboard/index.php') ?>">Dashboard</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= $page_title === 'Roles' ? 'active' : '' ?>" aria-current="page" href="<?= url_for('dashboard/role/roles.php') ?>">Roles</a>
                </li>
               
                <?php if ($name = Session::getSessionData('user_name')) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong class="text-success"><?= $name ?></strong>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= url_for('dashboard/profile.php') ?>">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="<?= url_for('dashboard/change_password.php') ?>">Change Password</a></li>
                            <li><a class="dropdown-item" href="<?= url_for('dashboard/logout.php') ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>
