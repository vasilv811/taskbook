<?php


namespace Core;


class Db
{
    public static $dbh;

    /**
     * @return \PDO
     */
    public static function getDb(): \PDO
    {
        if (self::$dbh == null) {
            try {
                $db = require_once dirname(__DIR__) . '/Config/config_db.php';
                self::$dbh = new \PDO($db['dsn'], $db['root'], $db['pass']);
                self::$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo 'Подключение не удалось   ' . $e->getMessage();
            }
        }
        return self::$dbh;
    }
}