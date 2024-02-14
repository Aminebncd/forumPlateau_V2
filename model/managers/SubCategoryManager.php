<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class SubCategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\SubCategory";
    protected $tableName = "subcategory";

    public function __construct(){
        parent::connect();
    }
}