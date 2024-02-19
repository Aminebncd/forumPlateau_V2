<?php 
use App\Session;

$post = $result["data"]["post"];


?>

<div id="form-container">

    <div id="form-header">
        <h1>Modifiez le post</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=updatePost&id=<?= $post->getId() ?>" method="post">

        <h2>Réponse actuelle :</h2>
        <p><?= $post->getContent() ?></p>
        
        <label for="content">Réponse modifiée :</label>
        <input id="content" type="text" name="content" value="">

        <button type="submit" name ="submit">submit</button>

    </form>
    
</div>