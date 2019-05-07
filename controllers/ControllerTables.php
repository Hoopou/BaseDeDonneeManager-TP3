<?php
    require_once('views/View.php');

    class ControllerTables
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {
            echo($_GET['ip']);
            if(isset($url) && count($url) > 2)
                throw new Exception('Page introuvable');
            else{
                $this->connecter();
            }
        }    

        private function connecter(){
            

        }

        private function afficherBaseDonnees(Connection $conn){
            $databases = $this->_model->getAllDatabases($conn);
            // var_dump($databases);
            $conn->setDatabases($databases);
            $this->_view = new View('Databases');
            $this->_view->generate(array('databases' => $databases));
        }
    }


?>
