<?php
class Dbh
{
    protected function connectToDatabase()
    {
        try {
            $db = new PDO(
                'mysql:host=localhost;
                            dbname=banque_php;
                            charset=utf8;',
                "bankadmin",
                "b1gmon3y",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $db->query("SET autocommit=0");
            return $db;
        } catch (Exception $error) {
            die("Error : " . $error->getMessage());
        }
    }
}
