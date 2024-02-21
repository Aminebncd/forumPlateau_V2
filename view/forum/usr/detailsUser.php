<?php
$user = $result["data"]['user']; 
$topics = $result["data"]['topics']; 
$posts = $result["data"]['posts']; 
?>



<?php
    if((App\Session::isAdmin()) || (App\Session::getUser()->getId() == $user->getId())){
        ?>
        <a href="index.php?ctrl=security&action=updateUserForm&id=<?= $user->getId() ?>">Modifier le profil</a> 
    <?php 
} 
?>

<header>
    <h1>Profil de <?= $user->getPseudo() ?></h1>
    <?= $user->showProfilePicture() ?>

</header>

<section>
    <h2>Liste des topics :</h2>
    <?php

// Affichage des topics s'il y en a
if (!empty($topics)) {
    foreach ($topics as $topic) { ?>
        <p>
            <a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
        </p>
    <?php }
} else {
    echo "<p>Aucun topic n'a été trouvé.</p>";
}
?>
</section>

<section>
    <h2>Liste des posts :</h2>
    <?php 

    if (!empty($posts)) {
        foreach($posts as $post){  ?>
            <div>
                <p><?= $post->getContent() ?></p>
            </div>
        <?php }
    } else {
        echo "<p>Aucun post n'a été trouvé.</p>";
    } 
    ?>
    
</section>
