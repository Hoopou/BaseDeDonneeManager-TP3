<?php
    require_once('views/View.php');

    class ControllerAccueil
    {
        private $_articleManager;
        private $_view;

        public function __construct($url)
        {
            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else if(isset($_GET['action'])){
                if($_GET['action'] == 'connecter'){
                    $this->connecter();
                }
            }else{
                $this->afficherAccueil();
            }

        }

        private function afficherAccueil()
        {
            // $this->_articleManager = new ArticleManager;
            // $articles = $this->_articleManager->getArticles();
           $none = null;
           $this->_view = new View('Accueil');
           $this->_view->generate(array('Acceuil' => $none));
        }
    }


?>