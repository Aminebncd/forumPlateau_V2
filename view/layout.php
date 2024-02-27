<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/main.css">
        <title>Le reve du chasseur</title>
        <meta name=“description” content="<?= $description ?>" />

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
                                    
                                        <li class="link-group user">
                                            <a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= App\Session::getUser()->getId() ?>">
                                                <span class="navPic"><?= App\Session::getUser()->showProfilePictureNav() ?></span>
                                                <?= App\Session::getUser()->getPseudo() ?>
                                            </a>
                                        </li>
                                    
                                        <li class="link-group"><a href="index.php?ctrl=topic&action=listTopics">Liste des Topics</a></li>
                                    
                                        <li class="link-group"><a href="index.php?ctrl=tag&action=listCategories">Liste des catégories</a>
                                            <ul class="subLinks">
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=1" class="category-link">Bloodborne</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=2" class="category-link">Elden Ring</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=3" class="category-link">Sekiro</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="link-group"><a href="index.php?ctrl=tag&action=listSubCategories">Liste des sous-catégories</a>

                                            <ul class="subLinks">
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=1" class="category-link">Guide</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=2" class="category-link">Humour</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=3" class="category-link">Hype</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=4" class="category-link">Discussion & Info</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=5" class="category-link">Aide</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=6" class="category-link">Speculation</a></li>
                                                
                                            </ul>
                                        </li>
                                    
                                    
                                        <!-- Pour les administrateurs -->
                                        <?php if (App\Session::isAdmin()): ?>
                                            
                                        <li class="link-group"><a href="index.php?ctrl=user&action=listUsers">Liste des utilisateurs</a></li>
                                            
                                        <?php endif; ?>
                                        
                                        <li class="link-group"><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                       

                                        <!-- Pour les utilisateurs non connectés -->
                                        <?php else: ?>
                                        <li class="link-group">
                                            <ul>
                                                <li><a href="index.php?ctrl=security&action=loginForm">Connexion</a></li>
                                                <li><a href="index.php?ctrl=security&action=registerForm">Inscription</a></li>
                                            </ul>
                                        </li>

                                        
                                        <li class="link-group" ><a href="index.php?ctrl=topic&action=listTopics">Liste des Topics</a></li>
                                    
                                    
                                        <li class="link-group" ><a href="index.php?ctrl=tag&action=listCategories">Liste des catégories</a>
                                            <ul class="subLinks">
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=1" class="category-link">Bloodborne</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=2" class="category-link">Elden Ring</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=3" class="category-link">Sekiro</a></li>
                                            </ul>
                                        </li>
                                        
                                        
                                        <li class="link-group"><a href="index.php?ctrl=tag&action=listSubCategories">Liste des sous-catégories</a>
                                            <ul class="subLinks">
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=1" class="category-link">Guide</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=2" class="category-link">Humour</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=3" class="category-link">Hype</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=4" class="category-link">Discussion & Info</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=5" class="category-link">Aide</a></li>
                                                <li><a href="index.php?ctrl=topic&action=listTopicsBySubCategory&id=6" class="category-link">Speculation</a></li>
                                            </ul>
                                        </li>
                                        
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

        <script src="<?= PUBLIC_DIR ?>js/script.js"></script>



    </body>
</html>