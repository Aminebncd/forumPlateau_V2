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
    public function listTopicsByCategory($id) {

        
            $categoryManager = new CategoryManager();
            $topicManager = new TopicManager();

            $category = $categoryManager->findOneById($id);
            // $user = $topicManager->findUserByTopic($id);
            $topics = $topicManager->findTopicsByCategory($id);


            if ($category) {
                return [
                    "view" => VIEW_DIR."forum/tags/detailsCategory.php",
                    // "meta_description" => "Liste des topics sous la catégorie : ".$subCategory,
                    "data" => [
                        "category" => $category,
                        // "user" => $user,
                        "topics" => $topics
                    ]
                ];
            } else {
                $this->redirectTo("home", "index");
            }
        
    }

    // Listage des topics par sous-categorie
    public function listTopicsBySubCategory($id) {

        $subCategoryManager = new SubCategoryManager();
        $topicManager = new TopicManager();

        $subCategory = $subCategoryManager->findOneById($id);
        // $user = $topicManager->findUserByTopic($id);
        $topics = $topicManager->findTopicsBySubCategory($id);

        if($subCategory) {
            return [
                "view" => VIEW_DIR."forum/tags/detailsSubCategory.php",
                // "meta_description" => "Liste des topics sous la catégorie : ".$subCategory,
                "data" => [
                    "subCategory" => $subCategory,
                    // "user" => $user,
                    "topics" => $topics
                ]
            ];
        } else {
            $this->redirectTo("home", "index");
        }
    }

    // listage des posts (réponses) sous un topic
    public function listPostByTopic($id) {
        // if(Session::getUser()){
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
        // }
    }









// FONCTIONS DE CREATION/MODIFICATION/SUPPRESION




    // TOPICS
    public function createTopicForm() { 
        if (Session::getUser()) {
            $subCategoryManager = new subCategoryManager();
            $subCategories = $subCategoryManager->findAll();
            $categoryManager = new categoryManager();
            $categories = $categoryManager->findAll();
            
                return [
                    "view" => VIEW_DIR."forum/topics/createTopic.php",
                    "data" => [
                        "title" => "Topic creation",
                        "subCategories" => $subCategories,
                        "categories" => $categories
                    ],
                    // "meta_description" => "creation form used to create topics"
                ];

            } else {
                return [
                    "view" => VIEW_DIR."security/register.php",
                    "data" => [
                        "title" => "Topic creation"
                    ],
                    // "meta_description" => "creation form used to create topics"
                ];    
        }
    }

    public function createTopic() {
        if(Session::getUser()){
            
            if (isset($_POST["submit"])) {

                $subCategoryManager = new subCategoryManager();
                $subCategories = $subCategoryManager->findAll();

                $categoryManager = new categoryManager();
                $categories = $categoryManager->findAll();

                $topicManager = new TopicManager(); 
                $topics = $topicManager->findAll();

                $postManager = new PostManager();


                
                $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                // $dateCreation = new \DateTime();
                //     $formattedDateCreation = $dateCreation->format('Y-m-d H:i:s');
                $closed = 0;
                $category_id = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
                $subCategory_id = filter_input(INPUT_POST, "subCategory", FILTER_SANITIZE_NUMBER_INT);
                $post = trim(filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_id = Session::getUser()->getId();
                
                $errorCheck = false; // wil become true is there is any problem in any form

                // checks every field
                if(empty($title)) {
                    Session::addFlash("title", "This field is mandatory!");
                    $errorCheck = true;
                }
                if(empty($category_id)) {
                    Session::addFlash("category", "This field is mandatory!");
                    $errorCheck = true;
                }
                if(empty($subCategory_id)) {
                    Session::addFlash("subCategory", "This field is mandatory!");
                    $errorCheck = true;
                }
                if(empty($post)) {
                    Session::addFlash("post", "This field is mandatory!");
                    $errorCheck = true;
                }
                
                if (!$errorCheck 
                 && !preg_match("/^[a-zA-Z0-9]$/", $title) 
                 && !preg_match("/^[a-zA-Z0-9]$/", $post )) {

                    $dataTopic = [
                        "title" => $title,
                        // "dateCreation" => $formattedDateCreation,
                        "closed" => $closed,
                        "subCategory_id" => $subCategory_id,
                        "category_id" => $category_id,
                        "user_id" => $user_id
                    ];
                    $successTopic = $topicManager->add($dataTopic);
                    
                    $topic_id = $successTopic;
                    $dataPost = [
                        'content' => $post,
                        'topic_id' => $topic_id,
                        "user_id" => $user_id
                    ];
                    $successPost = $postManager->add($dataPost);


                    if ($successTopic && $successPost) {
                        // Rediriger l'utilisateur vers la page du topic
                        $this->redirectTo("topic", "listTopics");
                    } 
                    
                    
                }
                
                return [
                    "view" => VIEW_DIR."forum/topics/createTopic.php",
                    "data" => [
                        "title" => "Topic creation",
                        "subCategories" => $subCategories,
                        "categories" => $categories
                    ],
                    // "meta_description" => "creation form used to create topics"
                ];
            } 
            
        } else {
            $this->redirectTo("security", "login");
            // echo "Veuillez vous connecter d'abord.";
        }
    }

    public function updateTopicForm($id) {
        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);

        if (Session::getUser()) {

            if ((Session::isAdmin()) 
             || (Session::getUser()->getId() == $topic->getUser()->getId())) {
                $subCategoryManager = new subCategoryManager();
                $subCategories = $subCategoryManager->findAll();

                $categoryManager = new categoryManager();
                $categories = $categoryManager->findAll();
                
                return [
                    "view" => VIEW_DIR."forum/topics/updateTopic.php",
                    "data" => [
                        "title" => "Topic update",
                        "topic" => $topic,
                        "subCategories" => $subCategories,
                        "categories" => $categories
                    ],
                    "meta" => "update an existing topic"
                ];
            }
        } else {
            Session::addFlash('stop', "Ce n'est pas ton topic désolé.");
            return [
                "view" => VIEW_DIR."security/stop.php",
                
            ];
        }
    }

    public function updateTopic($id) {

        $topicManager = new TopicManager();      
        $subCategoryManager = new subCategoryManager();
        $categoryManager = new categoryManager();
        $postManager = new PostManager();

        $topic = $topicManager->findOneById($id);
        $subCategories = $subCategoryManager->findAll();
        $categories = $categoryManager->findAll();
        $posts = $postManager->findPostsByTopic($id);

        if (isset($_POST["submit"])) {

            $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $category_id = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
            $subCategory_id = filter_input(INPUT_POST, "subCategory", FILTER_SANITIZE_NUMBER_INT);
            
            $errorCheck = false; // wil become true is there is any problem in any form

            // checks every field
            if(empty($title)) {
                Session::addFlash("title", "This field is mandatory!");
                $errorCheck = true;
            }
            if(empty($category_id)) {
                Session::addFlash("category", "This field is mandatory!");
                $errorCheck = true;
            }
            if(empty($subCategory_id)) {
                Session::addFlash("subCategory", "This field is mandatory!");
                $errorCheck = true;
            }
            
            if (!$errorCheck 
             && !preg_match("/^[a-zA-Z0-9]$/", $title)) {

                $dataTopic = [
                    "id_topic" => $id,
                    "title" => $title,
                    "dateCreation" => $topic->getDateCreation()->format('d/m/Y H:i:s'),
                    "closed" => $topic->isClosed(),
                    "subCategory_id" => $subCategory_id,
                    "category_id" => $category_id,
                    "user_id" => $topic->getUser()
                ];
 
                
                $topicManager->update($dataTopic);

                // $this->redirectTo("topics", "detailsTopic", $topic->getId());
                return [
                    "view" => VIEW_DIR."forum/topics/detailsTopic.php",
                    "data" => [
                        "title" => "Topic",
                        "topic" => $topic,
                        "posts" => $posts
                    ],
                ];
            }    

            // $this->redirectTo("topics", "updateTopic", $topic->getId());
            return [
                "view" => VIEW_DIR."forum/topics/updateTopic.php",
                "data" => [
                    "title" => "Topic",
                    "topic" => $topic,
                    "subCategories" => $subCategories,
                    "categories" => $categories
                ],
                // "meta_description" => "creation form used to create topics"
            ];
        }
    }
                


    public function topicState($id) {

        if (Session::isAdmin()){

            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);
    
            $postManager = new PostManager();
            $posts = $postManager->findPostsByTopic($id);
    
            $state = $topic->isClosed();
    
            if ($state == 1) {
                $topic->setClosed(0);
            } else {
                $topic->setClosed(1);
            }
    
            $dataTopic = [
                "id" => $id,
                "closed" => $topic->isClosed()
            ];
    
            $topicManager->update($dataTopic);
            $state = $topic->isClosed();
            // var_dump($topic->isClosed());
            // var_dump($topic->isClosed($id));
    
            return [
                "view" => VIEW_DIR."forum/topics/detailsTopic.php",
                "data" => [
                    "title" => "Topic update",
                    "topic" => $topic,
                    'posts' => $posts
                ],
                "meta" => "update an existing topic"
            ];
    
            $this->redirectTo("topic", "detailsTopic, $id");
        } else {
            Session::addFlash('stop', "tu n'as pas les droits pour faire ça mon coco");
            return [
                "view" => VIEW_DIR."security/stop.php",
                
            ];
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
        $topic = $topicManager->findOneById($id);
        // var_dump($topic);die;

        if(!$topic) {
            $this->redirectTo("home");
        }

        if (isset($_POST["submit"])) {
            $success = "";
            $errorCheck = false;

            $content = trim(filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $topic_id = $id;
            $user_id = Session::getUser()->getId();
            // $dateCreation = new \DateTime();
            //     $formattedDateCreation = $dateCreation->format('Y-m-d H:i:s');

            if(empty($content)) {
                Session::addFlash("content", "This field is mandatory!");
                $errorCheck = true;
            }
            
            if(!$errorCheck && !preg_match("/^[a-zA-Z0-9]$/", $content)) {
                $data = [
                    "content" => $content,
                    "topic_id" => $topic_id,
                    "user_id" => $user_id
                    // "dateCreation" => $formattedDateCreation
                ];
                $success = $postManager->add($data);
            }
            

            if ($success) {
                // Rediriger l'utilisateur vers la page du topic
                $this->redirectTo("topic", "listPostByTopic", $topic->getId());
            } else {
                // Gérer les erreurs
                $error = "Une erreur s'est produite lors de la mise à jour du message.";
            }   
            return [
                "view" => VIEW_DIR."forum/topics/detailsTopic.php",
                // "meta_description" => "Liste des topics sous la catégorie : ".$category,
                "data" => [
                    "topic" => $topic,
                    "posts" => $posts
                ]
            ];
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