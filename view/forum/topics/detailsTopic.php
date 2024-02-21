<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">supprimer le topic</a>
<a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>">modifier le topic</a>

<div id="form-container">
    <div id="form-header">
        <h1>ajoutez une reponse :</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=topic&action=createPost&id=<?= $topic->getId() ?>" method="post">
        <label for="content">contenu :</label>
        <textarea id="content" type="text" name="content" cols="60" rows="5" required></textarea>
        <button type="submit" name ="submit">soumettre</button>
    </form>
</div>

<h1>Liste des posts sous le topic : "<?= $topic->getTitle() ?>"</h1>


<?php
if (!empty($posts)) {
foreach($posts as $post ){ ?>
    <p>
        <?= $post->getContent() ?> par <?= $post->getUser() ?> <a href="index.php?ctrl=topic&action=deletePost&id=<?= $post->getId() ?>">supprimer</a> <a href="index.php?ctrl=topic&action=updatePostForm&id=<?= $post->getId() ?>">modifier</a>
    </p>
<?php } 
} else {
    echo "<p>Soyez le premier à repondre !</p>";
}
?>





  
