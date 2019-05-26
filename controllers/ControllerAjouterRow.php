<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerAjouterRow
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
                $this->afficherRows($conn , $databases , $_POST['table']);
            }else{
                throw new Exception('Page introuvable');
            }
        }    

        private function afficherRows(Connection $conn , String $databaseName , String $tableName){
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
            //ici, la table contient toutes les rangées avec les items
            
            // $_row = $table->arrayRow()[0];
            // $_tempItems = $_row->arrayItems();
            // array_shift($_tempItems);
            // $_row->setArrayItems($_tempItems);

            $this->_view = new View('AjouterRow');
            $this->_view->generate(array('table' => $table));
        }
    }


?>
