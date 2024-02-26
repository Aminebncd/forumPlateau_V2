<?php 
use App\Session;

$topic = $result["data"]["topic"];
$subCategories = $result["data"]["subCategories"];
$categories = $result["data"]["categories"];



?>

<div class="form=">
    <div id="form-header">
        <h1>Modifiez le topic</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input id="title" type="text" name="title" value="<?= $topic->getTitle() ?>" required>
            <?= Session::getFlash("title") ?>
        </div>

        <div class="form-group">
            <label for="category">Catégorie :</label>
            <select name="category" id="category" required>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->getId() ?>">
                        <?= $category->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= Session::getFlash("category") ?>
        </div>

        <div class="form-group">
            <label for="subCategory">Sous-catégorie :</label>
            <select name="subCategory" id="subCategory" required>
                <?php foreach($subCategories as $SubCategory): ?>
                    <option value="<?= $SubCategory->getId() ?>">
                        <?= $SubCategory->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= Session::getFlash("subCategory") ?>
        </div>

        <button type="submit" name="submit">Soumettre</button>
    </form>
</div>
