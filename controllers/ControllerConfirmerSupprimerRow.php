<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerConfirmerSupprimerRow
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {

            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else if(isset($_POST['database']) && isset($_POST['table'])){
                $databases = $_POST['database'];
                $conn = ControllerHelper::buildConnection();
                $this->afficherRows($conn , $databases , $_POST['table'], $_POST['rowid']);
            }else{
                throw new Exception('Page introuvable');
            }
        }    

        private function afficherRows(Connection $conn , String $databaseName , String $tableName, $myid){
            $model = new ModelsManager();
            $model->implementsDatabasesIntoConnection($conn);
            //ici, la connection a implementer toute les bases de donnée sans les tables
            $database = ControllerHelper::getDatabaseWithName($conn, $databaseName);
            //ici, la variable database contient la bonne base de donnée à qui il faut ajouter les tables
            $model->implementsTablesIntoDatabase($conn , $database);
            // ici, la base de donnée contient toutes les tables 
            $table = ControllerHelper::getTableWithName($database , $tableName);  //ici, il faut construire la table: au complet
            // $table = ControllerHelper::getColumnsFromTable($database , $tableName);  //ici, il faut construire la table: au complet
            //ici, la table est la bonne
            $table = $model->implementsRowsIntoTable($conn ,$database, $table);
            $table->setArrayColumns($model->getAllColumnsFromTable($conn,$database->name(),$tableName));

            // $temp_columns = $table->arrayColumns();
            // array_shift($temp_columns);
            // $table->setArrayColumns($temp_columns);

            
            $OldRow = null;
            foreach($table->arrayRow() as $row){
                if($row->myId() == $myid){
                    $OldRow = $row;
                    break;
                }
            }
            // $_tempOldArrayItem = $OldRow->arrayItems();
            // array_shift($_tempOldArrayItem);
            // $OldRow->setArrayItems($_tempOldArrayItem);
            
            $message = "";
            $model = new Model();
            if($model->deleteRowWhere($conn ,$databaseName, $tableName, $table->arrayColumns() , $OldRow) > 0){
                $message = "La rangée à bien été supprimer!";
            }else{
                $message = "Aucune rangée n'a été affectée , IL SEMBLE Y AVOIR EU UNE ERREUR!";
            }
            $this->_view = new View('message');
            $this->_view->generate(array('message' => $message));


        }
    }


?>
