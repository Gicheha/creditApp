<?php
/**
 * Created by PhpStorm.
 * User: Naomi
 * Date: 19-Jul-18
 * Time: 12:07 AM
 */

namespace sendCredit;


class creditAPI
{
    public $APIKey = 'someHashedValue';
    public $Accept = 'application/json';
    public $username = 'XYZCompany';
    public $recepients  = array();

    public function __construct($recepients)
    {
        $this->recepients = $recepients;
    }
}