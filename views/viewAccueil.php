<?php $this->_t = 'Mon blog';
foreach($articles as $article):?>
<a href="<?= URL?>Article/<?= $article->id()?>" ><h2><?= $article->title() ?></h2></a>
<time><?= $article->date()?></time>
<?php endforeach;?>