<?php
    $category = $result["data"]['category']; 
    $subCategories = $result["data"]['subCategories']; 
?>

<h1>Liste des topics sous la catégorie : <?= $category->getName() ?></h1>

<?php
foreach($subCategories as $subCategory ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsBySubCategory&id=<?= $subCategory->getId() ?>"><?= $subCategory->getName() ?></a></p>
<?php }


  
