<?php 
use App\Session;
// var_dump($fieldData);
?>

<form action="index.php?ctrl=security&action=register" method="post">
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <?= Session::getFlash("pseudo") ?>
    </div>
    <div>
        <label for="mail">Adresse e-mail :</label>
        <input type="email" id="mail" name="mail" required>
        <?= Session::getFlash("mail") ?>
    </div>
    <div>
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
        <?= Session::getFlash("motDePasse") ?>

        <small>Password must have at least :
            <ul>
                <li>1 Capital </li>
                <li>1 lowercase</li>
                <li>1 number</li>
                <li>1 special character (@ $ * # - ! ?)</li>
            </ul>
        </small>
    </div>
    <div>
        <label for="motDePasseAgain">Confirmer le mot de passe :</label>
        <input type="password" id="motDePasseAgain" name="motDePasseAgain" required>
        <?= Session::getFlash("motDePasseAgain") ?>
    </div>
    <div>
        <button type="submit" name="submit">S'inscrire</button>
    </div>
</form>
