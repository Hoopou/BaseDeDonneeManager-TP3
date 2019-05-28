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

        function deleteRowWhere(Connection $_connection , String $databaseName, String $tableName, $columns , $oldRow){// Command = 'DELETE FROM [TABLE] WHERE [COLUMN_NAME]=[VALUES] AND [COLUMN_NAME]=[VALUES] ...;'
            $command = 'DELETE FROM ' .$databaseName.'.'.$tableName. ' WHERE ';
            
            for($i = 0 ; $i<count($columns); $i++){
                if($oldRow->arrayItems()[$i]->value() != null && $oldRow->arrayItems()[$i]->value() != ''){
                    $command = $command.($columns[$i]->name().'=\''.htmlspecialchars($oldRow->arrayItems()[$i]->value()).'\' ');
                }
                if($i+1<count($columns) ){
                    if($oldRow->arrayItems()[$i+1]->value() != null && $oldRow->arrayItems()[$i+1]->value() != ''){
                        $command = $command.' AND ';
                    }
                }
            }
            $command = $command.';';

            echo($command);
            $req = $this->getBdd($_connection)->prepare($command) ;
            $req->execute();
            return $req->rowCount();
            $req->closeCursor();
        }

        function updateRowWhere(Connection $_connection , String $databaseName, String $tableName, $columns , $oldRow, $newRow){// Command = 'UPDATE [TABLE] SET [COLUMN_NAME]=[NEW_VALUES],[COLUMN_NAME]=[NEW_VALUES]... WHERE [COLUMN_NAME]=[OLD_VALUES] ...;'
            $command = 'UPDATE ' .$databaseName.'.'.$tableName. ' SET ';
            for($i = 0 ; $i<count($columns); $i++){
                if($newRow->arrayItems()[$i]->value() != null && $newRow->arrayItems()[$i]->value() != ''){
                    if($columns[$i]->displayableType() != 'file'){
                        $command = $command.($columns[$i]->name().'=\''.htmlspecialchars($newRow->arrayItems()[$i]->value()).'\' ');
                    }else{ //  est un fichier
                        $command = $command.($columns[$i]->name().'=\''.base64_encode($newRow->arrayItems()[$i]->value()).'\' ');
                    }
                }
                if($i+1<count($columns) ){
                    if($newRow->arrayItems()[$i+1]->value() != null && $newRow->arrayItems()[$i+1]->value() != ''){
                        $command = $command.' , ';
                    }
                }
            }
            $command = $command.'WHERE ';
            for($i = 0 ; $i<count($columns); $i++){
                if($oldRow->arrayItems()[$i]->value() != null && $oldRow->arrayItems()[$i]->value() != ''){
                    $command = $command.($columns[$i]->name().'=\''.htmlspecialchars($oldRow->arrayItems()[$i]->value()).'\' ');
                }
                if($i+1<count($columns) ){
                    if($oldRow->arrayItems()[$i+1]->value() != null && $oldRow->arrayItems()[$i+1]->value() != ''){
                        $command = $command.' AND ';
                    }
                }
            }
            $command = $command.';';

            echo($command);
            $req = $this->getBdd($_connection)->prepare($command) ;
            $req->execute();
            return $req->rowCount();
            $req->closeCursor();
        }

        function addRow(Connection $_connection , String $databaseName, String $tableName, $columns , $newRow){// Command = 'UPDATE [TABLE] SET [COLUMN_NAME]=[NEW_VALUES],[COLUMN_NAME]=[NEW_VALUES]... WHERE [COLUMN_NAME]=[OLD_VALUES] ...;'
            $commandFirst = 'INSERT INTO ' .$databaseName.'.`'.$tableName. '` (';
            $command = '';
            for($i = 0 ; $i<count($columns); $i++){
                $commandFirst = $commandFirst.'`'.$columns[$i]->name().'`';
                if($newRow->arrayItems()[$i]->value() != null && $newRow->arrayItems()[$i]->value() != ''){
                    $command = $command.'\''.htmlspecialchars($newRow->arrayItems()[$i]->value()).'\'';
                }else{
                    $command = $command.'null';
                }
                if($i+1<count($columns) ){

                        $commandFirst = $commandFirst.',';
                        $command = $command.' , ';
                    
                }
            }
            
            $commandFirst = $commandFirst.') VALUES (';
            $command = $command.');';
            $command = $commandFirst.$command;

            echo($command);
            $req = $this->getBdd($_connection)->prepare($command) ;
            $req->execute();
            return $req->rowCount();
            $req->closeCursor();
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
