<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/main.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <title>FORUM</title>
    </head>
    
    <body>

    

        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

                <header>
    <nav class="navbar">
        <div class="navContainer">
            <a class="navbar-brand" href="index.php?ctrl=home">Accueil</a>
            <div class="navbar-header">
                <button class="navbar-toggler" id="navbar-toggler">
                    <span class="navbar-toggler-icon">&#9776;</span>
                </button>
            </div>
            <div class="sidebar" id="sidebar">
                <ul class="navbar-nav">

                    <!-- Liens pour l'utilisateur connecté -->
                    <?php if (App\Session::getUser()): ?>
                        <div class="link-group user">
                            <li>
                                <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= App\Session::getUser()->getId() ?>">
                                    <span class="navPic"><?= App\Session::getUser()->showProfilePictureNav() ?></span>
                                    <?= App\Session::getUser()->getPseudo() ?>
                                </a>
                            </li>
                        </div>

                        <div class="link-group">
                            <li><a href="index.php?ctrl=topic&action=listTopics">Liste des Topics</a></li>
                        </div>
                        <div class="link-group">
                            <li><a href="index.php?ctrl=tag&action=listCategories">Liste des catégories</a>
                                <ul class="subLinks">
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=1" class="category-link">Bloodborne</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=2" class="category-link">Elden Ring</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=3" class="category-link">Sekiro</a></li>
                                </ul>
                            </li>
                            </div>
                            <div class="link-group">
                            <li><a href="index.php?ctrl=tag&action=listSubCategories">Liste des sous-catégories</a>
                                <ul class="subLinks">
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=1" class="category-link">Guide</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=2" class="category-link">Humour</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=3" class="category-link">Hype</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=4" class="category-link">Discussion & Info</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=5" class="category-link">Aide</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=6" class="category-link">Speculation</a></li>
                                </ul>
                            </li>
                        </div>
                        

                        <!-- Pour les administrateurs -->
                        <?php if (App\Session::isAdmin()): ?>
                            <div class="link-group">
                                <li><a href="index.php?ctrl=user&action=listUsers">Liste des utilisateurs</a></li>
                            </div>
                        <?php endif; ?>
                        <div class="link-group">
                            <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                        </div>

                    <!-- Pour les utilisateurs non connectés -->
                    <?php else: ?>
                        <div class="link-group">
                            <li><a href="index.php?ctrl=security&action=loginForm">Connexion</a></li>
                            <li><a href="index.php?ctrl=security&action=registerForm">Inscription</a></li>
                        </div>
                        <div class="link-group">
                            <li><a href="index.php?ctrl=topic&action=listTopics">Liste des Topics</a></li>
                        </div>
                        <div class="link-group">
                            <li><a href="index.php?ctrl=tag&action=listCategories">Liste des catégories</a>
                                <ul class="subLinks">
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=1" class="category-link">Bloodborne</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=2" class="category-link">Elden Ring</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=3" class="category-link">Sekiro</a></li>
                                </ul>
                            </li>
                            </div>
                            <div class="link-group">
                            <li><a href="index.php?ctrl=tag&action=listSubCategories">Liste des sous-catégories</a>
                                <ul class="subLinks">
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=1" class="category-link">Guide</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=2" class="category-link">Humour</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=3" class="category-link">Hype</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=4" class="category-link">Discussion & Info</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=5" class="category-link">Aide</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=6" class="category-link">Speculation</a></li>
                                </ul>
                            </li>
                        </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- Masque de la barre latérale pour l'effet d'assombrissement -->
        <div class="sidebar-mask" id="sidebar-mask"></div>
    </nav>
</header>




                <main id="forum">
                    <?= $page ?>
                </main>
            </div>
            <footer>
    <div class="footer-content">
        <div class="footer-links">
            <a href="#">Accueil</a>
            <a href="https://www.linkedin.com/feed/?trk=seo-authwall-base_sign-in-submit">LinkedIn</a>
            <a href="https://github.com/Aminebncd">Github</a>
        </div>
        <div class="footer-info">
            <p>&copy; <?= date_create("now")->format("Y") ?> - AmineBncd@ElanFormation - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
        </div>
    </div>
</footer>

        </div>



        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>

        <!-- <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script> -->

        <script src="<?= PUBLIC_DIR ?>js/script.js"></script>



    </body>
</html>