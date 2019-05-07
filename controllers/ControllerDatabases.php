<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');

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
            $this->_model = new ModelsManager();

            $conn = ControllerHelper::buildConnection();

            $connection = $this->_model->getConnectionValidity($conn);

            if($connection){
                $GLOBALS['ip'] = 'salut21';
                $this->afficherBaseDonnees($conn);
            }else{
                throw new Exception('Les informations entrées ne sont pas valides!');
            }

        }

        private function afficherBaseDonnees(Connection $conn){
            $this->_model->implementsDatabasesIntoConnection($conn);
            $this->_view = new View('Databases');
            $this->_view->generate(array('databases' => $conn->database() , 'conn' => $conn));
        }
    }


?>
