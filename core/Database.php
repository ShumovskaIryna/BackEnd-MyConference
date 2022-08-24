<?php

namespace core;


class Database
{
    private $db;

    public function __construct()
    {
        $paramsPath = ROOT . '/config/db.php';

        $params = include($paramsPath);


        $this->db = new \PDO('mysql:host=' . $params['host'], $params['user'], $params['password']);
        $sql = "CREATE DATABASE IF NOT EXISTS ". $params["dbname"];
        $this->db->exec($sql);
        $sql = NULL;
        $this->db = new \PDO('mysql:host=' . $params['host'] . ';dbname=' . $params["dbname"], $params['user'], $params['password']);
        $this->db->exec("set names utf8");

        $sql = "CREATE TABLE IF NOT EXISTS `conferences` ( 
            `id` INT AUTO_INCREMENT, 
            `name` VARCHAR(255), 
            `date` TIMESTAMP NOT NULL, 
            `location` POINT NOT NULL,
            country VARCHAR(100),
            
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            
            SPATIAL INDEX `SPATIAL` (`location`)
            PRIMARY KEY(`id`)
        )";

        $sth = $this->db->prepare($sql);
        $sth->execute();
    }

    public function getDb()
    {
        return $this->db;
    }


}