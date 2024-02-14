<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>profil de <?= $category->getName() ?></h1>

<h1>Liste des topics :</h1>

<?php
foreach($topics as $topic ){ ?>
    <p>
    <a href="index.php?ctrl=forum&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
         par <?= $topic->getUser() ?></p>
<?php } ?>


<h1>Liste des posts :</h1>

<?php
foreach($topics as $topic ){ ?>
    <p>
    <a href="index.php?ctrl=forum&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
         par <?= $topic->getUser() ?></p>
<?php } ?>


  
