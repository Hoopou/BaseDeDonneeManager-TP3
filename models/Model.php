<?php

     class Model{
        private static $_bdd;

        private static function setBdd(Connection $_connection)
        {
            if($_connection->database() == null){
                self::$_bdd = new PDO('mysql:host='.$_connection->host().';charset=utf8', $_connection->user(),$_connection->password());
            }else{
                $database = (Database) ($_connection->database());
                self::$_bdd = new PDO('mysql:host='.$_connection->host().';dbname='.$database->name().';charset=utf8', $_connection->user(),$_connection->password());
            }
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        protected function getBdd(Connection $_connection)
        {
            if(self::$_bdd == null)
                self::setBdd($_connection);
            return self::$_bdd;
        }

        // protected function getAll($table, $obj)
        // {
        //     $var = [];
        //     $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        //     $req->execute();
        //     while($data = $req->fetch(PDO::FETCH_ASSOC))
        //     {
        //         $var[] = new $obj($data);
        //     }            
        //     return $var;
        //     $req->closeCursor();
        // }

        function getConnectionValidity(Connection $_connection){ // en essayant de se connecter a la bd
            $access = false;
            try{
                $req = $this->getBdd($_connection)->prepare('show databases;');
                $access = true;
            }catch(Exception $e){

            }
            return $access;
            // $req->execute();
        }

        function getAllDatabases(Connection $_connection){ // Command = 'describe databases;'
            $var = [];
            $req = $this->getBdd($_connection)->prepare('show databases;');
            $req->execute();
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $var[] = new Database($data['Database']);
            }            
            return $var;
            $req->closeCursor();
        }

        function getAllTablesFromDatabases(Connection $_connection , String $database){ // Command = 'SHOW TABLES FROM [DATABASE];'
            $var = [];
            $req = $this->getBdd($_connection)->prepare('SHOW TABLES FROM '.$database.';');
            $req->execute();
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $var[] = new Table($data['Tables_in_'.$database]);
            }            
            return $var;
            $req->closeCursor();
        }

        function getAllColumnsFromTable(Connection $_connection , String $databaseName, String $tableName){ // Command = 'SHOW columns FROM [TABLE];'
            $var = [];
            $req = $this->getBdd($_connection)->prepare('DESCRIBE '.$databaseName.'.'.$tableName.';');
            $req->execute();
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $var[] = new Column($data);
            }            

            return $var;
            $req->closeCursor();
        }

        function &getAllRows(Connection $_connection , String $databaseName, String $tableName){ // Command = 'SELECT * FROM [TABLE];'
            $var = [];
            $req = $this->getBdd($_connection)->prepare('SELECT * FROM '.$databaseName.'.'.$tableName.';');
            $req->execute();
            $id = 0;
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $var[] = new Row($data , $id);
                $id++;
            }            

            return $var;
            $req->closeCursor();
        }

        function getRowWhere(Connection $_connection){ // Command = 'SELECT * FROM [TABLE] WHERE [COLUMN_NAME]=[VALUES] AND [COLUMN_NAME]=[VALUES] ...;'

        }

        function deleteRowWhere(Connection $_connection){// Command = 'DELETE FROM [TABLE] WHERE [COLUMN_NAME]=[VALUES] AND [COLUMN_NAME]=[VALUES] ...;'

        }

        function updateRowWhere(Connection $_connection){// Command = 'UPDATE [TABLE] SET [COLUMN_NAME]=[NEW_VALUES],[COLUMN_NAME]=[NEW_VALUES]... WHERE [COLUMN_NAME]=[OLD_VALUES] ...;'

        }

        function getTableInformations(Connection $_connection , String $databaseName, String $tableName){
            // Command = 'DESCRIBE [TABLE];'
            //OR
            // Command = 'SHOW FULL COLUMNS FROM [TABLE];'
            $var = [];
            $req = $this->getBdd($_connection)->prepare('DESCRIBE '.$databaseName.'.'.$tableName.';');
            $req->execute();
            $id = 0;
            while($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $var[] = new Row($data , $id);
                $id++;
            }            

            return $var;
            $req->closeCursor();


        }

        
    }


?>