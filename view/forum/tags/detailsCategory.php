<?php
// Récupération des données
$category = $result["data"]['category']; 
$subCategories = $result["data"]['subCategories']; 

// Bouton d'ajout d'une nouvelle sous-catégorie
?>

<h1>Liste des tags sous la catégorie : <?= $category->getName() ?></h1>

<?php
// Affichage des sous-catégories s'il y en a
if (!empty($subCategories)) {
    foreach($subCategories as $subCategory) { ?>
        <p><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=<?= $subCategory->getId() ?>"><?= $subCategory->getName() ?></a></p>
    <?php }
} else {
    echo "<p>Aucune sous-catégorie n'a été trouvée.</p>";
}
?>
