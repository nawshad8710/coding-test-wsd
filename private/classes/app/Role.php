<?php

namespace App;

use Database\Database;
use App\User;

class Role extends Database
{
    public static function all()
    {
        $sql = "SELECT * FROM `roles` ORDER BY `id` DESC";
        return parent::getRows($sql, []);
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM `roles` WHERE `id`=?";
        return parent::getRow($sql, [$id]);
    }

    public static function create($name)
    {
        $sql = "INSERT INTO `roles`(`name`) VALUES (?)";
        return parent::insertRow($sql, [$name]);
    }

    public static function update($name, $id)
    {
        $sql = "UPDATE `roles` SET `name`=? WHERE `id`=? LIMIT 1";
        return parent::insertRow($sql, [$name, $id]);
    }

    public static function delete($id)
    {
        User::updateUsersRole($id);
        $sql = "DELETE FROM `roles` WHERE `id` = ? LIMIT 1";
        return parent::deleteRow($sql, [$id]);
    }
}
// Create a new role to instantiate a Connection
$item = new Role;
