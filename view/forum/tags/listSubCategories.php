<?php
    $subCategories = $result["data"]['subCategories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($subCategories as $subCategory ){ ?>
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $subCategory->getId() ?>"><?= $subCategory->getName() ?></a></p>
<?php }


  
