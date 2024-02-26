<?php 
use App\Session;

?>

<form class="form" action="index.php?ctrl=security&action=newMdp" method="post">
    <div class="form-group">
        <label for="mail">Adresse e-mail :</label>
        <input type="email" id="mail" name="mail" required>
    </div>
    <div class="form-group">
        <label for="oldMotDePasse">Ancien mot de passe :</label>
        <input type="password" id="oldMotDePasse" name="oldMotDePasse" required>
    </div>
    <div class="form-group">
        <label for="NewMotDePasse">Nouveau mot de passe :</label>
        <input type="password" id="NewMotDePasse" name="NewMotDePasse" required>
    </div>
    <div class="form-group">
        <label for="NewMotDePasseAgain">Confirmez le mot de passe :</label>
        <input type="password" id="NewMotDePasseAgain" name="NewMotDePasseAgain" required>
    </div>
    <div class="form-group">
        <button form-group">
        <button class="form-button" type="submit" name="submit">Changer le mot de passe</button>
    </div>
</form>
