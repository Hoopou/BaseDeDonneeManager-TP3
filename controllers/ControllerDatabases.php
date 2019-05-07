<?php
    require_once('views/View.php');

    class ControllerDatabases
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {
            if(isset($url) && count($url) > 1)
                throw new Exception('Page introuvable');
            else{
                $this->connecter();
            }
        }    

        private function connecter(){
            $this->_model = new Model();

            $conn = new Connection();
            $conn->setHost($_POST['ip']);
            $conn->setPassword($_POST['password']);
            $conn->setUser($_POST['user']);

            $connection = $this->_model->getConnectionValidity($conn);

            if($connection){
                $this->afficherBaseDonnees($conn);
            }else{
                throw new Exception('Les informations entrées ne sont pas valides!');
            }

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
