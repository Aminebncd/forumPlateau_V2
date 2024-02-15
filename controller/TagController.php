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

class TagController extends AbstractController implements ControllerInterface{

    public function index() {
          

    }
   
    // liste nos trois grandes categories
    public function listCategories() {
        $categoryManager = new CategoryManager();
        
        $categories = $categoryManager->findAll();
        // var_dump($categories->current());die;
        
        return [
            "view" => VIEW_DIR."forum/tags/listCategories.php",
            // "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "categories" => $categories
            ]
        ];
    }
    
    // liste les sous-categories d'une categorie mère
    public function listSubCategories($id) {

        $categoryManager = new CategoryManager();
        $subCategoryManager = new SubCategoryManager();
        
        $category = $categoryManager->findOneById($id);
        $subCategories = $subCategoryManager->findByCategory($id);
        // var_dump($category->current());die;
        
        return [
            "view" => VIEW_DIR."forum/tags/detailsCategory.php",
            // "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "subCategories" => $subCategories
            ]
        ];
    }
}