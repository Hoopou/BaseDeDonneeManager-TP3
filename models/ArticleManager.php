<?php

class ArticleManager extends Model
{
    public function getArticles(){
        return $this->getAll('articles', 'Article'); // NOM DE LA TABLE , CLASSE OBJECT
    }

    public function getArticlesASC(){
        return $this->getAllASC('articles', 'Article'); // NOM DE LA TABLE , CLASSE OBJECT
    }

    public function getArticleById($id){
        return $this->getAllById('articles', 'Article', $id); // NOM DE LA TABLE , CLASSE OBJECT
    }
}

?>