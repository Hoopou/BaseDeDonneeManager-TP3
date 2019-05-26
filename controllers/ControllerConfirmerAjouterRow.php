<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerConfirmerAjouterRow
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

            
            // $_tempOldArrayItem = $OldRow->arrayItems();
            // array_shift($_tempOldArrayItem);
            // $OldRow->setArrayItems($_tempOldArrayItem);

            $_NewRow = new Row(null , $table->arrayRow()[count($table->arrayRow())-1]->myid());
            $_tempNewArrayItem = array();
            foreach($table->arrayColumns() as $_col){
                $_item = new Item($_POST[$_col->name()]);
                $_item->setType($_col->type());
                array_push($_tempNewArrayItem , $_item);
            }
            $_NewRow->setArrayItems($_tempNewArrayItem);
            
            $message = "";
            $model = new Model();
            if($model->addRow($conn ,$databaseName, $tableName, $table->arrayColumns() , $_NewRow) > 0){
                $message = "La rangée à bien été ajoutée!";
            }else{
                $message = "Aucune rangée n'a été affectée , IL SEMBLE Y AVOIR EU UNE ERREUR!";
            }
            $this->_view = new View('message');
            $this->_view->generate(array('message' => $message));


        }
    }


?>
