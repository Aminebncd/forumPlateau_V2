<?php
    $users = $result["data"]['users']; 
?>

<h1>Liste des utilisateurs</h1>

<?php
foreach($users as $user ){ ?>
    <p>
        <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= $user->getId() ?>"><?= $user->getPseudo() ?></a>
    </p>
<?php }


  