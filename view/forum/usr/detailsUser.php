<?php
    $user = $result["data"]['user']; 
    $topics = $result["data"]['topics']; 
    $posts = $result["data"]['posts']; 
?>

<h1>profil de <?= $user->getPseudo() ?></h1>
<p><?= $user->getRole() ?></p>


<p><?= $user->showProfilePicture() ?></p>
<p><?= $user->getMail() ?></p>



<h1>Liste des topics :</h1>

<?php
foreach($topics as $topic ){ ?>
    <p>
    <a href="index.php?ctrl=topic&action=listPostByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
         par <?= $topic->getUser() ?></p>
<?php } ?>


<h1>Liste des posts :</h1>

<?php
foreach($posts as $post ){ ?>
    <p><?= $post->getContent() ?></p>
<?php } ?>


  
