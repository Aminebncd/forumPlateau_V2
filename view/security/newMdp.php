<?php 
use App\Session;

?>

<form action="index.php?ctrl=security&action=newMdp" method="post">
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
