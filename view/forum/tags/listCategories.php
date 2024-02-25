<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php foreach ($categories as $category): ?>
    <div class="card">
        <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>" class="category-link">
            <div class="card-img" style="background-image: url('./public/img/assets/<?= $category->getImage() ?>');"></div>
            <div class="card-overlay"></div>
            <div class="card-content">
                <h3><?= $category->getName() ?></h3>
            </div>
        </a>
    </div>
<?php endforeach; ?>


  
