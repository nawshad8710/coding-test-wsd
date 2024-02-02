<?php

namespace App;

use Database\Database;
use Database\Session;

class User extends Database
{
    public static function login($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1";
        return parent::getRow($sql, [$email, $password]);
    }

    public static function logout()
    {
        Session::clearSession();
        redirect_to(url_for('index.php'));
        die;
    }

    public static function register($name, $email, $role, $password)
    {
        $sql = "INSERT INTO `users`(`name`, `email`, `role`, `password`) VALUES (?,?,?,?)";
        return parent::insertRow($sql, [$name, $email, $role, $password]);
    }

    public static function update($name, $email, $role, $id)
    {
        $sql = "UPDATE `users` SET `name`=?, `email`=?, `role`=? WHERE `id`=? LIMIT 1";
        return parent::updateRow($sql, [$name, $email, $role, $id]);
    }

    public static function updatePassword($password, $id)
    {
        $sql = "UPDATE `users` SET `password`=? WHERE `id`=? LIMIT 1";
        return parent::updateRow($sql, [$password, $id]);
    }

    // check if a user exists with an email
    public static function checkUser($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";
        return parent::getRow($sql, [$email]);
    }

    // check if a user exists with an email without a specific user
    public static function checkUserWithoutCurrentUser($email, $id)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? AND `id` <> ? LIMIT 1";
        return parent::getRow($sql, [$email, $id]);
    }

    public static function all()
    {
        $admin_email = Session::getSessionData('user_email');
        $sql = "SELECT u.*, r.name as role_name
                FROM `users` u
                LEFT JOIN `roles` r ON u.role=r.id
                ORDER BY `id` DESC";
        return parent::getRows($sql, []);
    }

    public static function findUser($id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ? LIMIT 1";
        return parent::getRow($sql, [$id]);
    }

    public static function findUserByEmail($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";
        return parent::getRow($sql, [$email]);
    }

    public static function authUser()
    {
        if (Session::getSessionData('user_logged')) {
            return true;
        } else {
            redirect_to(url_for('dashboard/login.php'));
            die;
        }
    }

    public static function authAdmin()
    {
        if (Session::getSessionData('user_role') == 1) {
            return true;
        } else {
            redirect_to(url_for('dashboard/login.php'));
            die;
        }
    }

    public static function isAdmin()
    {
        if (Session::getSessionData('user_role') == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE `id` = ? LIMIT 1";
        return parent::deleteRow($sql, [$id]);
    }

    public static function updateUsersRole($role_id)
    {
        $sql = "UPDATE `users` SET `role`=? WHERE `role`=?";
        return parent::updateRow($sql, [0, $role_id]);
    }
}
// Create a new user to instantiate a Connection
$user = new User;
