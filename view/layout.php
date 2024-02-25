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
                                    <?php if (App\Session::getUser()): ?>

                                    <li><a href="index.php?ctrl=user&action=whoIsThisUser&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()->getPseudo() ?></a></li>
                                    <li><a href="index.php?ctrl=tag&action=listCategories">Liste des catégories</a></li>
                                    <li><a href="index.php?ctrl=tag&action=listSubCategories">Liste des sous-catégories</a></li>
                                    <li><a href="index.php?ctrl=topic&action=listTopics">Liste des Topics</a></li>

                                    <?php if (App\Session::isAdmin()): ?>

                                    <li><a href="index.php?ctrl=user&action=listUsers">Liste des utilisateurs</a></li>

                                    <?php endif; ?>
                                    
                                    <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>

                                    <?php else: ?>

                                    <li><a href="index.php?ctrl=security&action=loginForm">Connexion</a></li>
                                    <li><a href="index.php?ctrl=security&action=registerForm">Inscription</a></li>

                                    <?php endif; ?>
                                </ul>
                            </div>
                            </div>
                                <div class="sidebar-mask" id="sidebar-mask"></div>
                            </div>
                        </div>
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
            <a href="#">LinkedIn</a>
            <a href="#">Github</a>
            <a href="#">Contact</a>
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

        <script>
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
        </script>

        <script src="<?= PUBLIC_DIR ?>js/script.js"></script>



    </body>
</html>