<?php
require_once '../../../private/initialize.php';

use App\User;
use Database\Session;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = file_get_contents('php://input');
    $data     = json_decode($response, true);

    // reciving all data
    $password    = md5($data['password']);
    $id      = $data['id'];

    $valid = true;

    if (empty($password) || empty($id)) {
        $return['status'] = 'Please fillup all the fields!';
        $valid = false;
    }

    if (strlen($data['password']) < 6) {
        $return['status'] = 'Password must be at least 6 characters!';
        $valid = false;
    }

    //check if the input data validation is ok
    if($valid == true){
        if ($user_update = User::updatePassword($password, $id)) { 
            $return['status'] = 'success';
            $return['url'] = "../index.php";
            Session::setSessionData('success_message', 'Password updated successfully!');
        } else {
            $return['status'] = 'Failed to update password!';
        }
    }

    echo json_encode($return);
}
