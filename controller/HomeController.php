<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        
        $topicManager = new TopicManager();
        
        $topics = $topicManager->findAll();
        // var_dump($topics->current());die;
        
        return [
            "view" => VIEW_DIR."home.php",
            // "meta_description" => "Liste des topics par catégorie : ".$topics,
            "data" => [
                "topics" => $topics
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }


    public function forumRules() {

        return [
            "view" => VIEW_DIR."rules.php"
        ];
    }
}
