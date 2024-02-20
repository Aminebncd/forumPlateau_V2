<?php 
use App\Session;

$subCategories = $result["data"]["subCategories"];
$categories = $result["data"]["categories"];


?>

<div id="form-container">

    <div id="form-header">
        <h1>Créez un topic</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=createTopic" method="post">
        
        <label for="title">Titre :</label>
        <input id="title" type="text" name="title" value="">
        

        <label for="category">Catégorie :</label>
        <select name="category" id="category">
            <?php foreach($categories as $category) { ?>
                <option value="<?= $category->getId() ?>">
                    <?= $category->getName() ?>
                </option>
            <?php  } ?>
        </select>

        <label for="subCategory">sous catégorie :</label>
        <select name="subCategory" id="subCategory">
            <?php foreach($subCategories as $SubCategory) { ?>
                <option value="<?= $SubCategory->getId() ?>">
                    <?= $SubCategory->getName() ?>
                </option>
            <?php  } ?>
        </select>

        <button type="submit" name ="submit">Poster</button>

    </form>
    
</div>