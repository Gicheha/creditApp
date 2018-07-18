<?php

/**
 * Created by PhpStorm.
 * User: Naomi
 * Date: 18-Jul-18
 * Time: 11:38 PM
 */

require_once('employee.php');
require_once('creditAPI.php');

use sendCredit\employee;
use sendCredit\creditAPI;

$request = file_get_contents("php://input");
$request_data = json_decode($request,true);

$eligible = array();
$rejected = array();

if(!empty($request_data))
{
    //Iterate through the Information recieved and check if the credit amounts are valid
    for($i = 0; $i < count($request_data); $i++)
    {
        //If Valid, Push employee object to a collection
        if(is_numeric($request_data[$i]['Amount']))
        {
            $name = $request_data[$i]['Employee-Name'];
            $number = $request_data[$i]['Phone-Number'];
            $amount = $request_data[$i]['Amount'];
            $individual = new employee($name,$number,$amount);

            array_push($eligible,$individual);
        }
        else
        {
            //Else Have the names in a list of rejects
            array_push($rejected,$request_data[$i]['Employee-Name']);
        }
    }

    //Send Credit Via the Africas Talking API
    #sendCredit($eligible);

    //Notify admin of faulty amounts
    notifyRejects($rejected);

}

function sendCredit($EmployeeList)
{
    $creditapi = new creditAPI($EmployeeList);

    //Further Logic to Send to Africa's Talking End Point
    echo json_encode($creditapi);
}

function notifyRejects($rejects)
{
    //Notify the admin of failed top ups due to invalid input or if all employees have received their credit
    $response = array();
    if(!empty($rejects))
    {
        $response['message'] = "The following did not get their recharge, Kindly confirm their details";
        for($i = 0; $i < count($rejects); $i++)
        {
            $response['names'] = " ,".$rejects[$i];
        }
        echo json_encode($response);
    }
    else
    {
        $response['message'] = "All accounts have been credited";
        echo json_encode($response);
    }
}