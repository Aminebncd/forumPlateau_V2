<?php
// Récupération des données
$topics = $result["data"]['topics'];

// Bouton d'ajout d'un nouveau topic
?>
<a href="index.php?ctrl=topic&action=createTopicForm">Ajouter un topic</a>
<h1>Liste des topics</h1>
<?php

// Affichage des topics s'il y en a
if (!empty($topics)) {
    foreach ($topics as $topic) { ?>
        <p>
            <a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?> "><?= $topic->getTitle() ?></a> 

            <a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=<?= $topic->getSubCategory()->getId() ?> ">(<?= $topic->getSubCategory() ?>)</a> 
            
            par <?= $topic->getUser() ?>
        </p>
    <?php }
} else {
    echo "<p>Aucun topic n'a été trouvé.</p>";
}
?>
