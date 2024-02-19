<?php 
use App\Session;

$topic = $result["data"]["topic"];


?>

<div id="form-container">

    <div id="form-header">
        <h1>Modifiez le topic</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">

        <h2>Titre actuel :</h2>
        <p><?= $topic->getTitle() ?></p>
        
        <label for="title">Nouveau titre :</label>
        <input id="title" type="text" name="title" value="">

        <button type="submit" name ="submit">submit</button>

    </form>
    
</div>