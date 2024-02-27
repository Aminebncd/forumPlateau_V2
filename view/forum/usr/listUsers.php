<?php
    $users = $result["data"]['users']; 
?>

<h1>Liste des utilisateurs</h1>

<div class="user-list">
    <?php foreach($users as $user): ?>
        <div class="user">
            <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= $user->getId() ?>" class="user-link">
                <div class="user-info">
                    <div class="user-avatar">
                        <?= $user->showProfilePicture() ?>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?= $user->getPseudo() ?></span>
                        <span class="user-registration-date">Inscrit depuis le <?= $user->getInscriptionDate()->format('d/m/Y') ?></span>
                    </div>
                </div>
            </a>
            <?php if(App\Session::isAdmin() && ($user->getPseudo() !== "deleted_user")): ?>
                <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>" class="delete-user">Supprimer</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
