<?php

class ControllerHelper{
    public static function buildConnection(){
        $conn = new Connection();
        $conn->setHost($_POST['ip']);
        $conn->setPassword($_POST['password']);
        $conn->setUser($_POST['user']);
        return $conn;
    }

    public static function getDatabaseWithName(Connection $conn , String $databaseName){
        foreach($conn->database() as $database){
            if($database->name() == $databaseName){
                return $database;
            }
        }
        return null;
    }

    public static function &getTableWithName(Database $database , String $tableName){
        foreach($database->arrayTables() as $table){
            if($table->name() == $tableName){
                return $table;
            }
        }
        return null;
    }
}


?>