<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics sous la catégorie : <?= $category->getName() ?></h1>

<?php
foreach($topics as $topic ){ ?>
    <p>
    <a href="index.php?ctrl=forum&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
         par <?= $topic->getUser() ?></p>
<?php }


  
