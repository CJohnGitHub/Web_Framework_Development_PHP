<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 01/05/2016
 * Time: 14:12
 */

namespace Itb\Controllers;

class ControllerUtility
{
    /**
     * add namespace to the string, after exploding controller name from action
     *
     * examples:
     * input:   Itb, main/index
     * output:  Itb\MainController::indexAction
     *
     * input:   Mattsmithdev\Samples, hello/name
     * output:  Mattsmithdev\Samples\HelloController::nameAction
     *
     * @param string $namespace
     * @param string $shortName controller and action name separate by "/"
     * @return string namespace, controller class name plus :: plus action name
     */
    public static function controller($namespace, $shortName)
    {
        list($shortClass, $shortMethod) = explode('/', $shortName, 2);
        $shortClassCapitalise = ucfirst($shortClass);
        $namespaceClassAction = sprintf($namespace . '\\' . $shortClassCapitalise . 'Controllers::' . $shortMethod . 'Action');
        return $namespaceClassAction;
    }
}