<?php

class ModelsManager extends Model
{
    public function implementsDatabasesIntoConnection(Connection $conn){
        $conn->setDatabases($this->getAllDatabases($conn));
        return $conn;
    }

    public function &implementsTablesIntoDatabase(Connection $conn , Database $database){
        $database->setArrayTables($this->getAllTablesFromDatabases($conn , $database->name()));
        return $database;
    }

    public function &implementsRowsIntoTable(Connection $conn , String $databaseName, Table $table){
        $table->setArrayRows($this->getAllRows($conn ,$databaseName, $table->name()));
        return $table;
    }
}

?>