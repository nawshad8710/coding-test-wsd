<?php

require_once '../../../private/initialize.php';

use App\User;
use Database\Session;

$id = $_GET['id'];

$delete_user= User::deleteUser($id);

if ($delete_user) {
    Session::setSessionData('success_message', 'User deleted successfully!');
    $return['status'] = 'success';
} else {
    $return['status'] = 'failure';
}
echo json_encode($return);
