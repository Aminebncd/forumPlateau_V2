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

            <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?> ">(<?= $topic->getCategory() ?>)</a> 
            
            par <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= $topic->getUser()->getId() ?> "><?= $topic->getUser() ?></a> 

            <?= $topic->getDateCreation()->format('d/m/Y H:i') ?>
        </p>
    <?php }
} else {
    echo "<p>Aucun topic n'a été trouvé.</p>";
}
?>
