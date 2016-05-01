<?php
namespace Itb\Controller;

use Itb\Model;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, Application $app)
    {
        $argsArray = [];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    public function processLogInAction(Request $request, Application $app)
    {
        // default is bad login
        $LoggedIn = false;
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //reference for User Class
        $user = new Model\User();

        //searching for the username and password if they have match
        $LoggedIn = $user->canFindMatchingUsernameAndPassword($username, $password);

        //searching if the role is exist
        $isRole = $user->canFindMatchingUsernameAndRole($username);

        // action depending on login success
        if ($LoggedIn) {
            $_SESSION['username'] = $username;
            $_SESSION['LoggedIn'] = $LoggedIn;
            $_SESSION['role'] = $isRole;
            $_SESSION['hasLoggedIn'] = "yes";

            // finding the username and password if they have match
            $argsArray = [
                'username' => $username,
                'nav' => $_SESSION['role']
            ];

            $templateName = 'login';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }


    public function forgetSession()
    {
        //Destroy session
        $this->killSession();

        //Send user back to the index page
        //$this->indexAction();
    }

    /**
     * killing the session when the user has been log out
     */
    public function killSession(Request $request, Application $app)
    {
        $_SESSION = [];
        session_destroy();

        $argsArray  = [
            'message' => 'YOU BEEN LOG OUT'
        ];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }





}