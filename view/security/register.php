<?php 
use App\Session;
// var_dump($fieldData);
?>

<form class="form" action="index.php?ctrl=security&action=register" method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <?= Session::getFlash("pseudo") ?>
    </div>
    <div class="form-group">
        <label for="mail">Adresse e-mail :</label>
        <input type="email" id="mail" name="mail" required>
        <?= Session::getFlash("mail") ?>
    </div>
    <div class="form-group">
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
        <?= Session::getFlash("motDePasse") ?>
        <p>Password must have at least :
            <ul>
                <li>1 Capital</li>
                <li>1 lowercase</li>
                <li>1 number</li>
                <li>1 special character (@ $ * # - ! ?)</li>
            </ul>
        </p>
    </div>
    <div class="form-group">
        <label for="motDePasseAgain">Confirmer le mot de passe :</label>
        <input type="password" id="motDePasseAgain" name="motDePasseAgain" required>
        <?= Session::getFlash("motDePasseAgain") ?>
    </div>
    <div class="form-group">
        <button form-group">
        <button class="form-button" type="submit" name="submit">S'inscrire</button>
    </div>
</form>

<a href="index.php?ctrl=security&action=loginForm">Déjà membre? connectez vous !</a>
