<?php
use App\Session;
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 

    if ($topic->isClosed() == 0){
        $state = "Ouvert";
    } else {
        $state = "Fermé";
    }

    // echo '<pre>'; var_dump($_SESSION); echo '</pre>'
    
?>
<?php
        if(Session::getUser() && ((Session::isAdmin()) || (Session::getUser()->getId() == $topic->getUser()->getId()))){
            ?>
            <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">supprimer le topic</a>
            <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>">modifier le topic</a>
            <?php 
        }
?>
<?php
        if(Session::isAdmin()){
            ?>
            <a href="index.php?ctrl=topic&action=topicState&id=<?= $topic->getId() ?>">
                <?php echo "<h2>Statut : $state</h2>";?>
            </a>
            <?php 
        }
?>

<?php 
        if ($topic->isClosed() == 0) { 
        if (Session::getUser()) { 
?>
            <div id="form-container">
                <div id="form-header">
                    <h1>ajoutez une reponse :</h1>
                </div>

                <form id="form-content" action="index.php?ctrl=topic&action=createPost&id=<?= $topic->getId() ?>" method="post">
                    <label for="content">contenu :</label>
                    <textarea id="content" type="text" name="content" cols="60" rows="5"></textarea>
                    <?= Session::getFlash("content") ?>
                    <button type="submit" name ="submit">soumettre</button>
                </form>
            </div>
<?php } else {
 echo "Veuilez vous connecter pour pouvoir répondre.";
}
        } else {
            echo "Topic cloturé.";
        } 
?>

<h1>Liste des posts sous le topic : "<?= $topic->getTitle() ?>"</h1>


<?php
        if (!empty($posts)) {
        foreach($posts as $post ){ 
?>
        <p>
        <?= $post->getContent() ?> par <?= $post->getUser() ?> 

<?php
        if(Session::getUser() && ((Session::isAdmin()) || (Session::getUser()->getId() == $topic->getUser()->getId()))){
?>
            <a href="index.php?ctrl=topic&action=deletePost&id=<?= $post->getId() ?>">supprimer</a> 
            <a href="index.php?ctrl=topic&action=updatePostForm&id=<?= $post->getId() ?>">modifier</a>
<?php 
        }
?>
        </p>
<?php       } 
        } else {
            echo "<p>Soyez le premier à repondre !</p>";
        }
?>





  
