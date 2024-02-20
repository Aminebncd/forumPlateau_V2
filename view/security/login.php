<?php 
use App\Session;

?>

<form action="index.php?ctrl=security&action=login" method="post">
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
    </div>
    
    <div>
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
    </div>
    
    <div>
        <button type="submit" name="submit">Connexion</button>
    </div>
</form>

<a href="index.php?ctrl=security&action=newMdpForm">Mot de passe oublié?</a>
