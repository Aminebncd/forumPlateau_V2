<?php
    // $subCategory = $result["data"]['subCategory']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>
<a href="index.php?ctrl=topic&action=createTopicForm">ajoutez un topic</a>

<?php
foreach($topics as $topic ){ ?>
    <p>
    <a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?> "><?= $topic->getTitle() ?></a>
         par <?= $topic->getUser() ?></p>
<?php }
