<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 06/04/2016
 * Time: 11:01
 */
namespace Itb\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

class User extends DatabaseTable
{
    //higher privillage access
    const ROLE_ADMIN = 2;

    //lower privillage access
    const ROLE_USER = 1;

    //meduim privillage access
    const ROLE_PROJECT_LEADER = 3;

    //supports the leader privillage access
    const ROLE_PROJECT_SECRETARY = 4;

    /**
     * varriables for id, username, password, and role
     * @var
     */
    private $id;
    private $username;
    private $password;
    private $role;


    /**
     * Setting the ID
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getting the ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Setting the username
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * getting the username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * hash the password before storing ...
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**
     * return success (or not) of attempting to find matching username/password in the repo
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function canFindMatchingUsernameAndPassword($username, $password)
    {
        $user = User::getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $user){
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedStoredPassword);
    }

    /**
     * looking for the user role 1 or 2 e.g. 2 = admin, 1 = users
     * @param $username
     * @return null
     */
    public static function canFindMatchingUsernameAndRole($username)
    {
        $user = User::getOneByUsername($username);

        if($user != null)
        {
           return $user -> getRole();
        }

        else
        {
            return null;
        }
    }

    /**
     * if record exists with $username, return User object for that record
     * otherwise return 'null'
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }


    public static function addNewStudentToDatabase($username, $password, $role)
    {
        $user = new User();
        $checkDatabase = User::getOneByUsername($username);

        //if the database is null
        //fill the database if they are admin
        if($checkDatabase == null) {
            //set new username
            print "<p>Adding new Students</p>";
            $user->setUsername("$username");
            //set new password
            $user->setPassword("$password");

            //so if they have role = 2 means they are admin
            if($role == 2)
            {
                //setting them to have admin if
                $user->setRole(User::ROLE_ADMIN);
                print "<p>New admin has been added to the database</p>";
            }

            else if($role == 3)
            {
                //setting them to have admin if
                $user->setRole(User::ROLE_PROJECT_LEADER);
            }

            else if($role == 4)
            {
                //setting them to have admin if
                $user->setRole(User::ROLE_PROJECT_SECRETARY);
            }

            //else if they roll = 1 means they have restriction area
            else
            {
                $user->setRole(User::ROLE_USER);
                print "<p>New user has been added to the database</p>";
            }
            //inserting all the data when admin inputs
            User::insert($user);
        }
        //they have to different username
        else {
            Print "<p>The username is in the database please pick a different one</p>";
        }
    }


    public static function removeStudentFromDatabase($username)
    {
        //checking the database by getting the username
        $checkDatabase = User::getOneByUsername($username);

        //checking if it is  not null
        if($checkDatabase != null)
        {
            //getting the databaseManager
            $db = new DatabaseManager();
            //
            $connection = $db->getDbh();

            $sql = 'DELETE FROM users WHERE username=:username';
            $stateFor = $connection->prepare($sql);
            $stateFor->bindParam(':username', $username, \PDO::PARAM_STR);
            $stateFor->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
            $stateFor->execute();

            print '<p>Student has been remove from the database</p>';
        }
        else
        {
            print '<p>No username has found' . $username .'</p>';
        }
    }

    public static function updateStudents($id, $username, $password, $role)
    {
        $checkDatabase = User::getOneByUsername($id);
        if($checkDatabase!=null) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $password = $hashedPassword;

            $db = new DatabaseManager();
            $connection = $db->getDbh();
            $sql = 'UPDATE users SET username=:username, password=:password, role=:role WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id, \PDO::PARAM_STR);
            $statement->bindParam(':username', $username, \PDO::PARAM_STR);
            $statement->bindParam(':password', $password, \PDO::PARAM_STR);
            $statement->bindParam(':role', $role, \PDO::PARAM_STR);
            $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
            $statement->execute();

            print "<p>User has been updated :)</p>";
        } else {
            print "<p>No user named : ".$id."</p>";
        }
    }
}