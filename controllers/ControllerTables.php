<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerTables
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {
            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else if(isset($_POST['database'])){
                $databases = $_POST['database'];
                $conn = ControllerHelper::buildConnection();
                $this->afficherTables($conn , $databases);
            }else{
                throw new Exception('Page introuvable');
            }
        }    

        private function afficherTables(Connection $conn , String $databaseName){
            $model = new ModelsManager();
            $conn = $model->implementsDatabasesIntoConnection($conn);
            //ici, la connection a implementer toute les bases de donnée sans les tables
            $database = ControllerHelper::getDatabaseWithName($conn, $databaseName);
            //ici, la variable database contient la bonne base de donnée à qui il faut ajouter les tables
            $model->implementsTablesIntoDatabase($conn , $database);
            // ici, la base de donnée contient toutes les tables 
            $this->_view = new View('Tables');
            $this->_view->generate(array('tables' => $database->arrayTables(),
                                         'database' => $database->name()       
                                        ));
        }
    }


?>
