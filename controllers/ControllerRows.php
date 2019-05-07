<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerRows
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {

            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else if(isset($_GET['database']) && isset($_GET['table'])){
                $databases = $_GET['database'];
                $conn = ControllerHelper::buildConnection();
                $this->afficherRows($conn , $databases , $_GET['table']);
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
            $table = new Table('');
            foreach($database->arrayTables() as $_table){
                if($_table->name() == $tableName){
                    $table = $_table;
                }
            }
            //ici, la table est la bonne
            $model->implementsRowsIntoTable($conn ,$database->name(), $table);
            //ici, la table contient toutes les rangées avec les items
            // var_dump($database->arrayTables());
            // var_dump($table->arrayRow());

            $this->_view = new View('Rows');
            $this->_view->generate(array('table' => $table->arrayRow(),
                                         'database' => $database->name()
                                        ));
        }
    }


?>
