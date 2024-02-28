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
                "topics" => $topics,
                "meta_description" => "Bienvenue sur dans le Rêve du Chasseur, un espace de discussions et de partage pour tous les passionnés de l'univers FromSoftware. Venez discuter des derniers sujets liés à Bloodborne, Elden Ring, Sekiro et bien plus encore."
            ]
        ];
    }
        
    public function users(){
        
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "data" => [ 
                "meta_description" => "Liste des utilisateurs du forum",
                "users" => $users 
            ]
        ];
    }


    // public function forumRules() {

    //     return [
    //         "view" => VIEW_DIR."rules.php"
    //     ];
    // }
}
