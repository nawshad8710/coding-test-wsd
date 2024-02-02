<?php

require_once '../../../private/initialize.php';

use App\Role;
use Database\Session;

$id = $_GET['id'];

$delete_user= Role::delete($id);

if ($delete_user) {
    Session::setSessionData('success_message', 'Role deleted successfully!');
    $return['status'] = 'success';
} else {
    $return['status'] = 'failure';
}
echo json_encode($return);
