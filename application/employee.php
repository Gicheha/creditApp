<?php
/**
 * Created by PhpStorm.
 * User: Naomi
 * Date: 18-Jul-18
 * Time: 11:24 PM
 */

namespace sendCredit;



class employee
{
    public $name;
    public $Number;
    public $Amount;

    public function __construct($name, $Number, $Amount)
    {
        //Instantiating the class attributes
        $this->name = $name;
        $this->Number = "+".$Number;
        $this->Amount = "KES ".$Amount;

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNumber()
    {
        return $this->Number;
    }

    public function setNumber($number)
    {
        $this->Number = "+".$number;
    }

    public function getAmount()
    {
        return $this->Amount;
    }

    public function setAmount($amount)
    {
        $this->Amount = "KES "+$amount;
    }
}