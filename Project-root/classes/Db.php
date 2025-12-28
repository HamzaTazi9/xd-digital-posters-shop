<?php

class Db {

    private static $conn;

    public static function getConnection() {

        if(self::$conn === null){

            $host = 'localhost';
            $dbname = 'selfique_store';
            $user = 'root';
            $password = 'root'; 

            self::$conn = new PDO(
                "mysql:host=$host;dbname=$dbname;port=3306;charset=utf8",
                $user,
                $password
            );

            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }
}
