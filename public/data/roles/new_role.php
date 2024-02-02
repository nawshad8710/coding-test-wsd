<?php

require_once '../../../private/initialize.php';

use App\Role;
use Database\Session;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = file_get_contents('php://input');
    $data     = json_decode($response, true);

    // reciving all data
    $name = $data['name'];

    $valid = true;

    if (empty($name)) {
        $return['status'] = 'Please fillup all the fields!';
        $valid = false;
    }

    if (strlen($name) > 20) {
        $return['status'] = 'Name must not be grater than 20 characters!';
        $valid = false;
    }

    //check if the input data validation is ok
    if($valid == true){
        // creating new product
        $create_new_role = Role::create($name);
        if ($create_new_role) {
            $return['status'] = 'success';
            $return['url'] = "roles.php";
            Session::setSessionData('success_message', 'New role has been created successfully!');
        } else {
            $return['status'] = 'failure';
        }
    }
    echo json_encode($return);
}
