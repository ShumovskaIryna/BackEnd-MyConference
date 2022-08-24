<?php

namespace app\Controllers;

use app\Models\Conferences;
use core\Router;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

class ConferencesController
{
    /**
     * Return all conferences
     */
    public function indexAction()
    {
        $conferences = Conferences::allFind();

        $conferences_arr = json_encode(array('data'=> array('conferences'=>$conferences))); 

        echo ($conferences_arr);

    }

    public function getOneById($id) 
    {
        $conference = Conferences::getOneById($id);

        if (empty($conference)) {
            echo('NOT_FOUND');

            return;
        }

        echo(json_encode(array('data'=>$conference)));

    }

    /**
     * Add new conferences
     */
    public function addAction()
    {
        $_SESSION["create"] = "true";

        $_POST = json_decode(file_get_contents('php://input'), true);


        $errors = array();
        // TODO: MOVE ALL THIS CHECK TO SEPARATE FUNCTION
        if (empty($_POST["name"]) || strlen($str) > 255) {
            // TODO: move to constant
            $errors["name"] = "NAME_IS_NOT_CORRECT";
            
        }

        if (empty($_POST["date"]) || !(is_numeric($_POST["date"]) && (int)$_POST["date"] == $_POST["date"])) {
            // TODO: move to constant
            $errors["date"] = "DATE_IS_NOT_CORRECT";
            echo($_POST["date"]);
            
        }

        if(empty($_POST["lat"]) || !Validator::isValidLatitude($_POST["lat"])) {
            // TODO: move to constant
            $errors["lat"] = "LAT_IS_NOT_CORRECT";
        }

        if(empty($_POST["lng"]) || !Validator::isValidLatitude($_POST["lng"])) {
            // TODO: move to constant
            $errors["lng"] = "LNG_IS_NOT_CORRECT";
        }

        // TODO: move to constant
        if(empty($_POST["country"]) || !is_string($_POST["country"]) || strlen($str) > 255) {
            // TODO: move to constant
            $errors["country"] = "COUNTRY_IS_NOT_CORRECT";
        }

        if (!empty($errors)) {
            echo(json_encode(array("errors"=>$errors)));

            die();
        }


        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
        $country = htmlspecialchars($_POST["country"], ENT_QUOTES, "UTF-8");


        $id = Conferences::insert($name, (int)$_POST["date"], (float)$_POST["lat"], (float)$_POST["lng"], $country);

        echo(json_encode(array("data"=>array('id'=>$id))));
    }

    /**
     * Delete conference
     */
    public function deleteAction($id)
    {
        Conferences::delete($id);    
        echo($id);    
    }

    /**
     * Update conference by id
     *
     * @param int $id
     */
    public function updateAction(int $id)
    {
        $_SESSION["edit"] = "true";

        $data = json_decode(file_get_contents('php://input'), true);

        $errors = array();
        // TODO: MOVE ALL THIS CHECK TO SEPARATE FUNCTION
        if (empty($data["name"]) || strlen($data["name"]) > 255) {
            // TODO: move to constant
            $errors["name"] = "NAME_IS_NOT_CORRECT";
            
        }

        if (empty($data["date"]) || !(is_numeric($data["date"]) && (int)$data["date"] == $data["date"])) {
            // TODO: move to constant
            $errors["date"] = "DATE_IS_NOT_CORRECT";
        }

        if(empty($data["lat"]) || !Validator::isValidLatitude($data["lat"])) {
            // TODO: move to constant
            $errors["lat"] = "LAT_IS_NOT_CORRECT";
        }

        if(empty($data["lng"]) || !Validator::isValidLatitude($data["lng"])) {
            // TODO: move to constant
            $errors["lng"] = "LNG_IS_NOT_CORRECT";
        }

        // TODO: move to constant
        if(empty($data["country"]) || !is_string($data["country"]) || strlen($str) > 255) {
            // TODO: move to constant
            $errors["country"] = "COUNTRY_IS_NOT_CORRECT";
        }

        if (!empty($errors)) {
            echo(json_encode($errors));

            die();
        }

        $name = htmlspecialchars($data["name"], ENT_QUOTES, "UTF-8");
        $country = htmlspecialchars($data["country"], ENT_QUOTES, "UTF-8");


        $afterUpdate = Conferences::edit($id, $name, (int)$data["date"], (float)$data["lat"], (float)$data["lng"], $country);
        
        echo(json_encode($afterUpdate));
    }

}