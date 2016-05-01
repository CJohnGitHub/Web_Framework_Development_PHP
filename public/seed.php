<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 06/04/2016
 * Time: 10:27
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Itb\User;

define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'online_team_project_system');

$admin = new User();
$admin->setUsername('admin');
$admin->setPassword('admin');
$admin->setRole(User::ROLE_ADMIN);

$charles= new User();
$charles->setUsername('charles');
$charles->setPassword('john');
$charles->setRole(User::ROLE_PROJECT_SECRETARY);

User::insert($admin);
User::insert($charles);


$users = User::getAll();

var_dump($users);