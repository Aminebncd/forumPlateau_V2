<?php
use App\Session;
$user = $result["data"]['user']; 
$topics = $result["data"]['topics']; 
$posts = $result["data"]['posts']; 
?>



<header id="myProfile">
    <h1>Profil de <?= $user->getPseudo() ?></h1>
    <div class="profile-picture">
        <?= $user->showProfilePicture() ?>
    </div>
    <?php if((Session::isAdmin()) || (Session::getUser()->getId() == $user->getId())): ?>
        <a href="index.php?ctrl=security&action=updateUserForm&id=<?= $user->getId() ?>" class="edit-profile">Modifier le profil</a>
    <?php endif; ?>
</header>

<main>
    <section class="topics-section">
        <h2>Liste des topics :</h2>
        <?php if (!empty($topics)): ?>
            <ul class="topic-list">
                <?php foreach ($topics as $topic): ?>
                    <li><a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun topic n'a été trouvé.</p>
        <?php endif; ?>
    </section>

    <section class="posts-section">
        <h2>Liste des posts :</h2>
        <?php if (!empty($posts)): ?>
            <ul class="post-list">
                <?php foreach ($posts as $post): ?>
                    <li><?= $post->getContent() ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun post n'a été trouvé.</p>
        <?php endif; ?>
    </section>
</main>
