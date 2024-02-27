<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\CategoryManager;
use Model\Managers\SubCategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class UserController extends AbstractController implements ControllerInterface{

    public function index() {
          

    }

    // affiche les informations d'un utilisateur precis
    public function whoIsThisUser($id) {

        if (Session::getUser()) {

            $userManager = new userManager();
            $topicManager = new TopicManager();
            $postManager = new PostManager();
    
            $user = $userManager->findOneById($id);
            $topics = $topicManager->findTopicsByUser($id);
            $posts = $postManager->findPostsByUser($id);
    
            return [
                "view" => VIEW_DIR."forum/usr/detailsUser.php",
                "data" => [
                    "meta_description" => "Détail du profil de : ".$user,
                    "user" => $user,
                    "topics" => $topics,
                    "posts" => $posts
                ]
            ];
        } else {
            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => [
                    "meta_description" => "Formulaire de connexion."
                ]
            ];
        }
    }

    // liste tous les utilisateurs 
    public function listUsers() {
        
        if (Session::isAdmin()) {

            $userManager = new UserManager();
            $users = $userManager->findAll();
            // var_dump($users);die;
    
            return [
                "view" => VIEW_DIR."forum/usr/listUsers.php",
                "data" => [
                    "meta_description" => "Liste des utilisateurs",
                    "users" => $users
                ]
            ];
        } else {
            Session::addFlash("stop", "petit fouineur lol t'as rien à faire ici");

            return [
                "view" => VIEW_DIR."security/stop.php",
                "data" => [
                    "meta_description" => "hmmmmmm you're not supposed to be here."
                ]
            ];
        }
    }



}