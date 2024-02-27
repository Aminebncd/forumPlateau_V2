<?php
// Récupération des données
$topics = $result["data"]['topics'];
$topics = $result["data"]['topics'];

// Bouton d'ajout d'un nouveau topic
?>



<main id="home">
    <div class="mainContainer">
        <h1>Bienvenue sur dans le Rêve du Chasseur</h1>
        <p>Un espace de discussions et de partage pour tous les passionnés de l'univers FromSoftware.</p>
        
    </div>

    <a href="index.php?ctrl=topic&action=createTopicForm" class="add-topic-btn">Ajouter un topic</a>
    
    <?php
// Affichage des topics s'il y en a
if (!empty($topics)) {
    ?>
    <div class="topics-list">
        <?php 
        $count = 0; // Initialisation du compteur 
        foreach ($topics as $topic): ?>
            <div class="topic <?= ($count === 0) ? 'first-topic' : ''; ?>">
                <?php $count++; // Incrémentation du compteur ?>

                <div class="topic-header">
                                <h2 class="topic-title"><a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></h2>
                            </div>

                <div class="topic-details">

                    <span class="topic-category">
                        
                        <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?>"><?= $topic->getCategory()->colorTag() ?></a>
                        <a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=<?= $topic->getSubCategory()->getId() ?>"><?= $topic->getSubCategory()->colorSubTag()?></a>
                    </span>

                    <span class="topic-author">
                        par <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= $topic->getUser()->getId() ?>"><?= $topic->getUser() ?></a>
                    </span>

                    <span class="topic-date"><?= $topic->getDateCreation()->format('d/m/Y H:i') ?></span>
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
<?php 
} else {
    echo "<p>Aucun topic n'a été trouvé.</p>";
}
?>

</main>