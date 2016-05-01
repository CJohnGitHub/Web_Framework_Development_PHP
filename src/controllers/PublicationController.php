<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 06/04/2016
 * Time: 11:01
 */

namespace Itb;


class PublicationController
{
    public function listAction()
    {
        $publications = Publication::getAll();
        require_once __DIR__ . '/../templates/publications/list.php';
    }
}