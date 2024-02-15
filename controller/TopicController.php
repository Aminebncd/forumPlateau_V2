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

class TopicController extends AbstractController implements ControllerInterface{

    public function index() {
          

    }
   
    // Listage de tous les topics peu importe les tags 
    public function listTopics() {
        $topicManager = new TopicManager();
        
        $topics = $topicManager->findAll();
        // var_dump($topics->current());die;
        
        return [
            "view" => VIEW_DIR."forum/topics/listTopics.php",
            // "meta_description" => "Liste des topics par catégorie : ".$topics,
            "data" => [
                "topics" => $topics
            ]
        ];
    }

    // Listage des topics par sous-categorie
    public function listTopicsBySubCategory($id) {

        $subCategoryManager = new SubCategoryManager();
        $topicManager = new TopicManager();

        $subCategory = $subCategoryManager->findOneById($id);
        // $user = $topicManager->findUserByTopic($id);
        $topics = $topicManager->findTopicsBySubCategory($id);

        return [
            "view" => VIEW_DIR."forum/tags/detailsSubCategory.php",
            // "meta_description" => "Liste des topics sous la catégorie : ".$subCategory,
            "data" => [
                "subCategory" => $subCategory,
                // "user" => $user,
                "topics" => $topics
            ]
        ];
    }

    // listage des posts (réponses) sous un topic
    public function listPostByTopic($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/topics/detailsTopic.php",
            // "meta_description" => "Liste des topics sous la catégorie : ".$category,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function createTopicForm() { 
       

        $subCategoryManager = new subCategoryManager();
        $subCategories = $subCategoryManager->findAll();

        
            return [
                "view" => VIEW_DIR."forum/topics/createTopic.php",
                "data" => [
                    "title" => "Topic creation",
                    "subCategories" => $subCategories
                ],
                // "meta_description" => "creation form used to create topics"
            ];
            
        

    }

    public function createTopic() {

        $topicManager = new TopicManager(); 
        $topics = $topicManager->findAll();
        
        if (isset($_POST["submit"])) {

            
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateCreation = new \DateTime();
                $formattedDateCreation = $dateCreation->format('Y-m-d H:i:s');
            $closed = 0;
            $subCategory_id = filter_input(INPUT_POST, "subCategory", FILTER_SANITIZE_NUMBER_INT);
            $user_id = 1;
            
            $data = [
                "title" => $title,
                "dateCreation" => $formattedDateCreation,
                "closed" => $closed,
                "subCategory_id" => $subCategory_id,
                "user_id" => $user_id
            ];
                
            $success = $topicManager->add($data);
        
            if ($success) {
                return [
                    "view" => VIEW_DIR . "forum/topics/listTopics.php",
                    // "meta_description" => "Liste des topics par catégorie : ".$topics,
                    "data" => [
                        "topics" => $topics,
                        "error" => isset($error) ? $error : null
                    ]
                ]; 
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de l'ajout du sujet.";
            }
        }
    }

    // public function createPostForm($id) {
        
    //     $topicManager = new topicManager();
    //     $topic = $topicManager->findOneById($id);

    //         return [
    //             "view" => VIEW_DIR."forum/topics/createPost.php",
    //             "data" => [
    //                 "title" => "Post creation"
    //             ]
    //             // "meta_description" => "creation form used to create topics"
    //         ];
    // }


    public function createPost($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        
        $posts = $postManager->findAll();
        $topic = $topicManager->findOneById($id);

        if (isset($_POST["submit"])) {

            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topic_id = $id;
            $user_id = 1;
            $dateCreation = new \DateTime();
                $formattedDateCreation = $dateCreation->format('Y-m-d H:i:s');
            
            $data = [
                "content" => $content,
                "topic_id" => $topic_id,
                "user_id" => $user_id,
                "dateCreation" => $formattedDateCreation
            ];
                
            $success = $postManager->add($data);
        
            if ($success) {
                return [
                    "view" => VIEW_DIR . "forum/topics/detailsTopic.php",
                    // "meta_description" => "Liste des topics par catégorie : ".$topics,
                    "data" => [
                        "topic" => $topic,
                        "posts" => $posts,
                        "error" => isset($error) ? $error : null
                    ]
                ]; 
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de l'ajout du sujet.";
            }
        }
    }



}