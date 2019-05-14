<?php

class ControllerHelper{
    public static function &buildConnection(){
        $conn = new Connection();
        $conn->setHost($_POST['ip']);
        $conn->setPassword($_POST['password']);
        $conn->setUser($_POST['user']);
        return $conn;
    }

    public static function getDatabaseWithName(Connection $conn , String $databaseName){
        $_tempDatabase = new Database($databaseName);
        foreach($conn->database() as $database){
            if($database->name() == $databaseName){
                $_tempDatabase = $database;
                return $database;
            }
        }
        return $_tempDatabase;
    }

    public static function &getTableWithName(Database $database , String $tableName){
        $_tempTable = new Table($tableName);
        foreach($database->arrayTables() as $table){
            if($table->name() == $tableName){
                return $table;
            }
        }
        return $_tempTable;
    }

    public static function getColumnsFromTable($database , $tableName , Model $DbManager){
        $_tempArrayColumns[] = new Column("");
    }
}


?>