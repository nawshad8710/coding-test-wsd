<?php
require_once '../../../private/initialize.php';

use App\User;
use Database\Session;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = file_get_contents('php://input');
    $data     = json_decode($response, true);

    // reciving all data
    $name    = $data['name'];
    $email   = $data['email'];
    $role    = $data['role'];
    $id      = $data['id'];

    $valid = true;

    if (empty($name) || empty($id)) {
        $return['status'] = 'Please fillup all the fields!';
        $valid = false;
    }

    if (strlen($name) > 20) {
        $return['status'] = 'Name must not be grater than 50 characters!';
        $valid = false;
    }

    //check if the input data validation is ok
    if($valid == true){
        // check if user exist? if not then create a new user
        if (User::checkUserWithoutCurrentUser($email, $id)) {
            $return['status'] = 'user_exist';
        } else if ($user_update = User::update($name, $email, $role, $id)) {
            $return['status'] = 'success';
            $return['url'] = "../index.php";
            Session::setSessionData('success_message', 'User info updated successfully!');
        } else {
            $return['status'] = 'Failed to update user!';
        }
    }

    echo json_encode($return);
}
