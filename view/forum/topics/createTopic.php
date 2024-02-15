<?php 
use App\Session;

$subCategories = $result["data"]["subCategories"];


?>

<div id="form-container">

    <div id="form-header">
        <h1>Créez un topic</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=createTopic" method="post">
        
        <label for="title">Titre :</label>
        <input id="title" type="text" name="title" value="">
        

        <label for="subCategory">sous catégorie :</label>
        <select name="subCategory" id="subCategory">
            <?php foreach($subCategories as $SubCategory) { ?>
                <option value="<?= $SubCategory->getId() ?>">
                    <?= $SubCategory->getName() ?>
                </option>
            <?php  } ?>
        </select>

        <button type="submit" name ="submit">submit</button>

    </form>
    
</div>