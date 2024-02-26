<?php
use App\Session;
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts'];
    // $users = $result["data"]['users'];
    

    if ($topic->isClosed() == 0){
        $state = "Ouvert";
    } else {
        $state = "Fermé";
    }

    // echo '<pre>'; var_dump($_SESSION); echo '</pre>'
    
?>

<h1 class="post-list-title"><?= $topic->getTitle() ?></h1>

<div class="container">
    
    <?php if(Session::getUser() && ((Session::isAdmin()) || (Session::getUser()->getId() == $topic->getUser()->getId()))): ?>
        <div class="topic-actions">
            <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>" class="delete-topic">Supprimer le topic</a>
            <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>" class="update-topic">Modifier le topic</a>
        </div>
    <?php endif; ?>

    <?php if(Session::isAdmin()): ?>
        <a href="index.php?ctrl=topic&action=topicState&id=<?= $topic->getId() ?>" class="topic-state"><h2>Statut : <?= $state ?></h2></a>
    <?php endif; ?>

    <?php if ($topic->isClosed() == 0): ?>
        <?php if (Session::getUser()): ?>
            <div class="reply-form-container">
                <div class="form-header">
                    <h2>Ajoutez une réponse :</h2>
                </div>
                <form id="form-content" action="index.php?ctrl=topic&action=createPost&id=<?= $topic->getId() ?>" method="post">
                    <label for="content">Contenu :</label>
                    <textarea id="content" type="text" name="content" cols="60" rows="3"></textarea>
                    <?= Session::getFlash("content") ?>
                    <button class="form-button" type="submit" name="submit">répondre</button>
                </form>
            </div>
        <?php else: ?>
            <p>Veuillez vous connecter pour pouvoir répondre.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Topic clôturé.</p>
    <?php endif; ?>

    <div class="replies-container">
    <?php if (!empty($posts)): ?>
        <?php foreach($posts as $post ): ?>
            <div class="post">
                <div class="upper-post">
                    <div class="user-profile">
    
                        <?= $post->getUser()->showProfilePicturePost() ?>
    
                        <div class="user-info">
                            <span class="user-name"><?= $post->getUser()->getPseudo() ?></span>
                            <span class="user-name"><?= $post->getDateCreation()->format('d/m h:i') ?></span>
                        </div>  
    
                        
                    </div>
                    <?php if(Session::getUser() && ((Session::isAdmin()) || (Session::getUser()->getId() == $post->getUser()->getId()))): ?>
    
                    <div class="post-actions">
                        <a href="index.php?ctrl=topic&action=deletePost&id=<?= $post->getId() ?>" class="delete-post">Supprimer</a> 
                        <a href="index.php?ctrl=topic&action=updatePostForm&id=<?= $post->getId() ?>" class="update-post">Modifier</a>
                    </div>
                    
                    <?php endif; ?>
                </div>

                <div class="separator"></div>

                <div class="post-content">
                    <p><?= $post->getContent() ?></p>
                </div>
                
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Soyez le premier à répondre !</p>
    <?php endif; ?>
</div>

</div>





  
