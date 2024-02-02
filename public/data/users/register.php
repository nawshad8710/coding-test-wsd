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
    $role   = $data['role'];
    $password = md5($data['password']);

    $valid = true;

    if (empty($name) || empty($email) || empty($role) || empty($password)) {
        $return['status'] = 'Please fillup all the fields!';
        $valid = false;
    }

    if (strlen($data['password']) < 6) {
        $return['status'] = 'Password must be at least 6 characters!';
        $valid = false;
    }

    if (strlen($name) > 50) {
        $return['status'] = 'Name must not be grater than 50 characters!';
        $valid = false;
    }

    //check if the input data validation is ok
    if($valid == true){
        // check if user exist? if not then create a new user
        if (User::checkUser($email)) {
            $return['status'] = 'user_exist';
        } else if ($user_register = User::register($name, $email, $role, $password)) {
            $return['status'] = 'success';
            $return['url'] = "../index.php";
            Session::setSessionData('success_message', 'New user added successfully!');
        } else {
            $return['status'] = 'Failed to add new user!';
        }
    }

    echo json_encode($return);
}
