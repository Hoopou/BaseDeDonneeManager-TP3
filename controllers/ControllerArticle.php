<?php
    require_once('views/View.php');

    class ControllerArticle
    {

        private $_view;

        public function __construct($url)
        {
            if(isset($url) && count($url) > 2)
                throw new Exception('Page introuvable');
            else
            $this->article($url[1]);
        }

        private function article($id)
        {
            $this->_articleManager = new ArticleManager;
            $articles = $this->_articleManager->getArticleById($id);
            $article = $articles[0];

            //test d'utilisation de variable statique
            //$article->setContent(pepega);   //fonctionnel

            $this->_view = new View('Article');
            $this->_view->generate(array('article' => $article));
        }
    }


?>

