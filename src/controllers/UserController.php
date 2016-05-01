<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 12/04/2016
 * Time: 16:41
 */

namespace Itb;


class UserController
{
    public function listUsers()
    {
        //getting all the user listUsers
        $users = User::getAll();

        //when user log in getting all the users in the table
        if(isset($_SESSION['LoggingIn'])) {
            if ($_SESSION["LoggingIn"] == 1) {
                require __DIR__ . '/../templates/listUsers/listUsers.php';
            }
        }
    }
}