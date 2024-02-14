<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }
    
    public function listCategories() {
        $categoryManager = new CategoryManager();
        
        $categories = $categoryManager->findAll();
        // var_dump($category->current());die;
        
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            // "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "categories" => $categories
            ]
        ];
    }
        
    public function listTopics() {
        $topicManager = new TopicManager();
        
        $topics = $topicManager->findAll();
        // var_dump($topics->current());die;
        
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            // "meta_description" => "Liste des topics par catégorie : ".$topics,
            "data" => [
                "topics" => $topics
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();

        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/detailsCategory.php",
            // "meta_description" => "Liste des topics sous la catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    // public function listPostsByUser($id) {

    //     $topicManager = new TopicManager();
    //     $categoryManager = new CategoryManager();
    //     $category = $categoryManager->findOneById($id);
    //     $topics = $topicManager->findTopicsByCategory($id);

    //     return [
    //         "view" => VIEW_DIR."forum/detailsCategory.php",
    //         // "meta_description" => "Liste des topics sous la catégorie : ".$category,
    //         "data" => [
    //             "category" => $category,
    //             "topics" => $topics
    //         ]
    //     ];
    // }

    public function listPostByTopic($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/detailsTopic.php",
            // "meta_description" => "Liste des topics sous la catégorie : ".$category,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }
            
    public function listUsers() {
        $userManager = new UserManager();

        $users = $userManager->findAll();
        // var_dump($users);die;

        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            // "meta_description" => "Liste des utilisateurs : ".$users,
            "data" => [
                "users" => $users
            ]
        ];
    }


}