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
        <div class="form-group">
            <label for="title">Titre :</label>
            <input id="title" type="text" name="title" required >
            <?= Session::getFlash("title") ?>
        </div>

        <div class="form-group">
            <label for="category">Catégorie :</label>
            <select name="category" id="category" required >
                <?php foreach($categories as $category) { ?>
                    <option value="<?= $category->getId() ?>">
                        <?= $category->getName() ?>
                    </option>
                <?php  } ?>
            </select>
            <?= Session::getFlash("category") ?>
        </div>

        <div class="form-group">
            <label for="subCategory">Sous-catégorie :</label>
            <select name="subCategory" id="subCategory" required >
                <?php foreach($subCategories as $SubCategory) { ?>
                    <option value="<?= $SubCategory->getId() ?>">
                        <?= $SubCategory->getName() ?>
                    </option>
                <?php  } ?>
            </select>
            <?= Session::getFlash("subCategory") ?>
        </div>

        <div class="form-group">
            <label for="post">Contenu :</label>
            <textarea id="post" type="text" name="post" required></textarea>
            <?= Session::getFlash("post") ?>
        </div>

        <button type="submit" name="submit">Poster</button>
    </form>
</div>
