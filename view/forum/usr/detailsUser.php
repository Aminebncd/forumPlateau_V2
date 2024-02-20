<?php
$user = $result["data"]['user']; 
$topics = $result["data"]['topics']; 
$posts = $result["data"]['posts']; 
?>


<header>
    <h1>Profil de <?= $user->getPseudo() ?></h1>
    <!-- Afficher la photo de profil -->
    <?= $user->showProfilePicture() ?>
    
    <p>Email : <?= $user->getMail() ?></p>
</header>

<section>
    <h2>Liste des topics :</h2>
    <?php foreach($topics as $topic): ?>
        <div>
            <h3><a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></h3>
        </div>
    <?php endforeach; ?>
</section>

<section>
    <h2>Liste des posts :</h2>
    <?php foreach($posts as $post): ?>
        <div>
            <p><?= $post->getContent() ?></p>
        </div>
    <?php endforeach; ?>
</section>

