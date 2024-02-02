<?php
require_once '../../../private/initialize.php';

use App\Role;
use Database\Session;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = file_get_contents('php://input');
    $data     = json_decode($response, true);

    // reciving all data
    $name    = $data['name'];
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
       if ($role_update = Role::update($name, $id)) {
            $return['status'] = 'success';
            $return['url'] = "roles.php";
            Session::setSessionData('success_message', 'Role updated successfully!');
        } else {
            $return['status'] = 'Failed to update role!';
        }
    }

    echo json_encode($return);
}
