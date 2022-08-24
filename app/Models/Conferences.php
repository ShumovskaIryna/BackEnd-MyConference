<?php

namespace app\Models;

use core\Database;

class Conferences
{


    private static $tableName = 'conferences';
    /**
     * Insert into conferences
     *
     * @param string string $name, int $date, float $lat, float $lng, string $country
     *
     * @return void
     *
     */
    public static function insert(string $name, int $date, float $lat, float $lng, string $country): int
    {
        $db = new Database();
        $db = $db->getDb();
 
        $sql = "
        INSERT INTO 
            conferences (name, date, location, country) 
        VALUES ('$name', $date, Point($lat, $lng), '$country');";


        $sth = $db->prepare($sql);
        $sth->execute();

        return $db->lastInsertId();
    }

    /**
     * Get all info
     *
     * @param
     *
     * @return array
     *
     */
    public static function allFind(): array
    {
        $db = new Database();
        $db = $db->getDb();
        $sql = "   
        select 
            conf.id, conf.name, conf.date, ST_X(location) as lat, ST_Y(location) as lng,
            conf.country 
        FROM 
            conferences as conf
        ORDER BY conf.created_at desc;
        ";

        $sth = $db->prepare($sql);
        $sth->execute();
        $conferencesAll = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $conferencesAll;

    }

    /**
     * Delete conferences
     *
     * @param int $id
     *
     * @return void
     *
     */
    public static function delete(int $id): void
    {
        $db = new Database();
        $db = $db->getDb();
        $sql = "DELETE FROM `conferences` WHERE `id` = '$id' ";
        $sth = $db->prepare($sql);
        $sth->execute();
    }

    /**
     * Find conferences
     *
     * @param int $id
     *
     * @return array
     *
     */
    public static function getOneById(int $id): array
    {
        $db = new Database();
        $db = $db->getDb();
        $sql = "SELECT             
            conf.id, conf.name, conf.date, ST_X(location) as lat, ST_Y(location) as lng,
            conf.country, conf.created_at
        FROM conferences  as conf WHERE `id` = '$id' LIMIT 1";

        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            return [];
        }

        return $result;
    }


    /**
     * Update conferences
     *
     * @param int $id , string $name, int $date, float $lat, float $lng, string $country
     *
     * @return void
     *
     */
    public static function edit(int $id, string $name, int $date, float $lat, float $lng, string $country)
    {
        $db = new Database();
        $db = $db->getDb();

        $sql = "
        UPDATE `conferences` 
        SET 
            `name`='$name',`date`='$date', 
             location = POINT('$lat', '$lng'),
             `country`='$country' 
        WHERE `id` = '$id'";

        $sth = $db->prepare($sql);
        $sth->execute();

        $sqlSelect = "SELECT             
            conf.id, conf.name, conf.date, ST_X(location) as lat, ST_Y(location) as lng,
            conf.country, conf.created_at
        FROM conferences  as conf WHERE `id` = '$id' LIMIT 1";

        $select = $db->prepare($sqlSelect);
        $select->execute();

        return $select->fetch(\PDO::FETCH_ASSOC);

    }

}