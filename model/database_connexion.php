<?php 
    try {
        $db = new PDO('mysql:host=localhost;
                        dbname=banque_php;
                        charset=utf8;',"bankadmin","b1gmon3y",
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $error){
        die("Error : " . $error->getMessage());
    }
