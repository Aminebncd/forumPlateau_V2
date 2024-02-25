<?php 
use App\Session;

?>

<form class="login-form" action="index.php?ctrl=security&action=login" method="post">
    <h2>Connexion</h2>
    <div class="form-group">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
    </div>
    <div class="form-group">
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
    </div>
    <div class="form-group">
        <button type="submit" name="submit">Connexion</button>
    </div>
</form>

<a href="index.php?ctrl=security&action=newMdpForm" class="forgot-password">Mot de passe oublié?</a>
