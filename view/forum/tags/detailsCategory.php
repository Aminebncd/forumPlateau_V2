<?php
// Récupération des données
$category = $result["data"]['category'];  
$topics = $result["data"]['topics']; 

// Bouton d'ajout d'un nouveau topic
?>
<a href="index.php?ctrl=topic&action=createTopicForm">Ajouter un topic</a>
<h1>Liste des topics sous le tag : <?= $category->getName() ?></h1>

<?php
// Affichage des topics s'il y en a
if (!empty($topics)) {
    foreach($topics as $topic) { ?>
        <p>
            <a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?> "><?= $topic->getTitle() ?></a>
            par <?= $topic->getUser() ?>
        </p>
    <?php }
} else {
    echo "<p>Aucun topic n'a été trouvé.</p>";
}
?>
