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
   













    
// FONCTIONS DE LISTAGE

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






// FONCTIONS DE CREATION/MODIFICATION/SUPPRESION















    // TOPICS
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
        
        if (isset($_POST["submit"])) {
            
            $topicManager = new TopicManager(); 
            $topics = $topicManager->findAll();
            
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

            $id = lastInsertId();
                
            $success = $topicManager->add($data);
        
            if ($success) {
                // Rediriger l'utilisateur vers la page du topic
                $this->redirectTo("topic", "detailsTopic", $id);
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de l'ajout du sujet.";
            }
        }
    }

    public function updateTopicForm($id) {

        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);
        
        return [
            "view" => VIEW_DIR."forum/topics/updateTopic.php",
            "data" => [
                "title" => "Topic update",
                "topic" => $topic
            ],
            "meta" => "update an existing topic"
        ];
    }

    public function updateTopic($id) {

        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);

        $postManager = new PostManager();
        $posts = $postManager->findPostsByTopic($id);

        if (isset($_POST["submit"])) {

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $dataTopic = [
            "id" => $id,
            "title" => $title
        ];

        // var_dump($id);die;
        $success = $topicManager->update($dataTopic);
        
            if ($success) {
                // Rediriger l'utilisateur vers la page du topic
                $this->redirectTo("topic", "detailsTopic", $topic);
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de l'ajout du sujet.";
            }
        }
       
    }

    public function deleteTopic($id) {

        $topicManager = new TopicManager();

        $topics = $topicManager->findAll();
        $topic = $topicManager->findOneById($id);

        $this->clearPosts($id);
        $success = $topicManager->delete($id);

        if ($success) {
            // Rediriger l'utilisateur vers la page du topic
            $this->redirectTo("topic", "listTopics");
        } else {
            // Gérer les erreurs
            $error = "Une erreur s'est produite lors de la mise à jour du message.";
        } 
    }














    // POSTS
    public function createPost($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        
        $posts = $postManager->findPostsByTopic($id);
        $topic = $topicManager->findOneById($id)->getId();

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
                // Rediriger l'utilisateur vers la page du topic
                $this->redirectTo("topic", "listPostByTopic", $topic);
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de la mise à jour du message.";
            } 
        }
    }

    public function updatePostForm($id) {

        $postManager = new PostManager;
        $post = $postManager->findOneById($id);
        
        return [
            "view" => VIEW_DIR."forum/topics/updatePost.php",
            "data" => [
                "title" => "post update",
                "post" => $post
            ],
            "meta" => "update an existing topic"
        ];
    }

    public function updatePost($id) {

        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
        $topic = $post->getTopic()->getId();
        $posts = $postManager->findPostsByTopic($topic);
     
        if (isset($_POST["submit"])) {

        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $dataPost = [
            "id" => $id,
            "content" => $content
        ];

        $success = $postManager->update($dataPost);
        
        if ($success) {
            // Rediriger l'utilisateur vers la page du topic
            $this->redirectTo("topic", "listPostByTopic", $topic);
        } else {
            // Gérer les erreurs
            $error = "Une erreur s'est produite lors de la mise à jour du message.";
        }
        }
       
    }

    public function deletePost($id) {
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        $posts = $postManager->findAll();
        $topic = $postManager->findOneById($id)->getTopic()->getId();

        $success = $postManager->delete($id);

        if ($success) {
            // Rediriger l'utilisateur vers la page du topic
            $this->redirectTo("topic", "listPostByTopic", $topic);
        } else {
            // Gérer les erreurs
            $error = "Une erreur s'est produite lors de la mise à jour du message.";
        } 
    }

    public function clearPosts($id) {
        $postManager = new PostManager();
        $posts = $postManager->findPostsByTopic($id);
        foreach ($posts as $post) {
            $postManager->delete($post->getId());
        }
    }




}