<?php 
use App\Session;

$topic = $result["data"]["topic"];
$subCategories = $result["data"]["subCategories"];
$categories = $result["data"]["categories"];



?>

<div id="form-container">

    <div id="form-header">
        <h1>Modifiez le topic</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">
        
        <label for="title">Titre :</label>
        <input id="title" type="text" name="title" required >
        <?= Session::getFlash("title") ?>

        <label for="category">Catégorie :</label>
        <select name="category" id="category" required >
            <?php foreach($categories as $category) { ?>
                <option value="<?= $category->getId() ?>">
                    <?= $category->getName() ?>
                </option>
            <?php  } ?>
        </select>
        <?= Session::getFlash("category") ?>

        <label for="subCategory">sous catégorie :</label>
        <select name="subCategory" id="subCategory" required >
            <?php foreach($subCategories as $SubCategory) { ?>
                <option value="<?= $SubCategory->getId() ?>">
                    <?= $SubCategory->getName() ?>
                </option>
            <?php  } ?>
        </select>
        <?= Session::getFlash("subCategory") ?>

        <button type="submit" name ="submit">submit</button>

    </form>
    
</div>