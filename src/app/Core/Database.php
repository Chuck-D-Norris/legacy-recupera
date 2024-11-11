<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    public static function connect()
    {
        if (!self::$instance) {
            try {
                $password_file_path = getenv('PASSWORD_FILE_PATH');

                // Read the password from the file
                $db_pass = trim(file_get_contents($password_file_path));

                self::$instance = new PDO(
                    "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'),
                    getenv('DB_USER'), $db_pass
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                Logger::log("Database connection error: " . $e->getMessage());
                throw new \Exception("Database connection failed.");
            }
        }
        return self::$instance;
    }

    public static function prepareAndExecute($query, $params = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $db = self::connect();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll($fetchMode);
        } catch (PDOException $e) {
            Logger::log("Database query error: " . $e->getMessage());
            throw new \Exception("Query failed.");
        }
    }
}
