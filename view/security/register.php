<?php 
use App\Session;

?>

<form action="index.php?ctrl=security&action=register" method="post">
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
    </div>
    <div>
        <label for="mail">Adresse e-mail :</label>
        <input type="email" id="mail" name="mail" required>
    </div>
    <div>
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
    </div>
    <div>
        <label for="motDePasseAgain">Confirmer le mot de passe :</label>
        <input type="password" id="motDePasseAgain" name="motDePasseAgain" required>
    </div>
    <div>
        <button type="submit" name="submit">S'inscrire</button>
    </div>
</form>
