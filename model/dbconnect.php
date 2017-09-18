<?php

class DbConnect
{
    private static $db;

    private function __construct($host, $db_name, $user, $pwd)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        }
    }

    public static function getConnect()
    {
        if (!self::$db) {
            self::$db = new DbConnect("localhost", "bee", "root", "");
        }
        return self::$db->conn;
    }

    private function __clone()
    {
        return true;
    }

    private function __wakeup()
    {
        return true;
    }
}
