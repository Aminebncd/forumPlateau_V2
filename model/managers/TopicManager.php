<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id
                ORDER BY t.dateCreation DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsBySubCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.subCategory_id = :id
                ORDER BY t.dateCreation DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findUserByTopic($id) {

        $sql = "SELECT user_id 
                FROM ".$this->tableName." t 
                WHERE t.subCategory_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // récupérer tous les topics d'un user spécifique (par son id)
    public function findTopicsByUser($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.user_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // public function isClosed($id) {
    //     $sql = "SELECT closed
    //     FROM".$this->tableName." t
    //     WHERE t.id_topic = :id";

    //     return $this->getOneOrNullResult(
    //         DAO::select($sql, ['id' => $id], false), 
    //         $this->className
    //     );

    //     if (closed == 1) {
    //         return ["CLOSED"];
    //     } else {
    //         return ["OPEN"];
    //     }
    // }

    
    
}