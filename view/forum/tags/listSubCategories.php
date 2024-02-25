<?php
    $subCategories = $result["data"]['subCategories']; 
?>

<h1>Liste des sous-catégories</h1>

<div class="subCategories-grid">
    <?php foreach ($subCategories as $subCategory): ?>
        <a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=<?= $subCategory->getId() ?>" class="tag"><?= $subCategory->getName() ?></a>
    <?php endforeach; ?>
</div>
