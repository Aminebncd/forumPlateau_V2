<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=forum&action=listSubCategories&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php }


  
