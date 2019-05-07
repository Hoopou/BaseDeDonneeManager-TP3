<?php
    require_once('views/View.php');

    class ControllerAPropos
    {
        private $_view;

        public function __construct($url)
        {
            var_dump($url);
            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else{
                $this->afficherPage();
            }

        }

        private function afficherPage()
        {
            // $this->_articleManager = new ArticleManager;
            // $articles = $this->_articleManager->getArticles();
           $articles = null;
           $this->_view = new View('APropos');
           $this->_view->generate(array('APropos' => $articles));
        }
    }
?>