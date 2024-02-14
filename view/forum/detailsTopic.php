<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts sous le topic : <?= $topic->getTitle() ?></h1>

<?php
foreach($posts as $post ){ ?>
    <p>
        <?= $post->getContent() ?> par <?= $post->getUser() ?>
    </p>
<?php }


  