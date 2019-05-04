<?php

    abstract class Model{
        private static $_bdd;

        private static function setBdd()
        {
            self::$_bdd = new PDO('mysql:host=localhost;dbname=miniblog;charset=utf8',
            'root','password');
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        protected function getBdd()
        {
            if(self::$_bdd == null)
                self::setBdd();
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

        protected function getConnectionValidity(){ // en essayant de se connecter a la bd
        }

        protected function getAllDatabases(){ // Command = 'describe databases;'

        }

        protected function getAllTablesFromDatabases(){ // Command = 'SHOW TABLES FROM [DATABASE];'

        }

        protected function getAllColumnsFromTable(){ // Command = 'SHOW columns FROM [TABLE];'

        }

        protected function getAllRows(){ // Command = 'SELECT * FROM [TABLE];'

        }

        protected function getRowWhere(){ // Command = 'SELECT * FROM [TABLE] WHERE [COLUMN_NAME]=[VALUES] AND [COLUMN_NAME]=[VALUES] ...;'

        }

        protected function deleteRowWhere(){// Command = 'DELETE FROM [TABLE] WHERE [COLUMN_NAME]=[VALUES] AND [COLUMN_NAME]=[VALUES] ...;'

        }

        protected function updateRowWhere(){// Command = 'UPDATE [TABLE] SET [COLUMN_NAME]=[NEW_VALUES],[COLUMN_NAME]=[NEW_VALUES]... WHERE [COLUMN_NAME]=[OLD_VALUES] ...;'

        }

        protected function getTableInformations(){
            // Command = 'DESCRIBE [TABLE];'
            //OR
            // Command = 'SHOW FULL COLUMNS FROM [TABLE];'



        }

        
    }


?>