<?php

require_once('../private/initialize.php');

use Database\Session;

$count = 1;
$page_title = 'Home';

if (Session::getSessionData('user_logged')) {
    redirect_to(url_for('dashboard'));
    die;
}else{
    redirect_to(url_for('dashboard/login.php'));
    die;
}

?>


<!-- #####=START Header=##### -->
<?php require_once(SHARED_PATH . '/header.php'); ?>
<!-- #####=END Header=##### -->
<!-- #####=START Main nav=##### -->
<?php require_once(SHARED_PATH . '/main_nav.php'); ?>
<!-- #####=END Main nav=##### -->

<!-- main content -->
<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1 class="text-center mb-4">All products</h1>
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Location</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $count++ ?></th>
                            <td><?= $product['name'] ?></td>
                            <td>$<?= $product['unit_price'] ?></td>
                            <td><?= $product['location'] ?></td>
                            <td>
                                <div class="input-group mx-auto" style="width: 120px;">
                                    <button onclick="decrease(event)" class="input-group-text">-</button>
                                    <input type="text" class="form-control quantity" value="1">
                                    <button onclick="increase(event)" class="input-group-text">+</button>
                                </div>
                            </td>
                            <td>
                                <button onclick="buyProduct(event, <?= $product['id'] ?>)" class="btn btn-sm btn-primary">Buy<i class="fas fa-shopping-basket ms-1"></i></button>
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
