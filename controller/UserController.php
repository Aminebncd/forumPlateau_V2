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

        $userManager = new userManager();
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $user = $userManager->findOneById($id);
        $topics = $topicManager->findTopicsByUser($id);
        $posts = $postManager->findPostsByUser($id);

        return [
            "view" => VIEW_DIR."forum/usr/detailsUser.php",
            // "meta_description" => "Liste des topics sous la catégorie : ".$user,
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }

    // liste tous les utilisateurs 
    public function listUsers() {
        $userManager = new UserManager();

        $users = $userManager->findAll();
        // var_dump($users);die;

        return [
            "view" => VIEW_DIR."forum/usr/listUsers.php",
            // "meta_description" => "Liste des utilisateurs : ".$users,
            "data" => [
                "users" => $users
            ]
        ];
    }


}