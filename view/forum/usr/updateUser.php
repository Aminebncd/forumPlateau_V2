<?php 
use App\Session;

$user = $result["data"]["user"];


?>

<div id="form-container">

    <div id="form-header">
        <h1>Modifiez votre profil</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=updateUser&id=<?= $user->getId() ?>" method="post" enctype="multipart/form-data">
        
        <label for="pseudo">Nouveau Pseudo :</label>
        <input id="pseudo" type="text" name="pseudo" value="">

        <label for="mail">Nouveau Mail :</label>
        <input id="mail" type="email" name="mail" value="">

        <label for="profilePic">Nouvelle photo de profil :</label>
        <input id="profilePic" type="file" name="profilePic" value="">

        <button type="submit" name ="submit">submit</button>

    </form>
    
</div>