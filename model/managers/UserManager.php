<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function findUserByPseudo($pseudo) {
        $sql = 
        "SELECT 
            *
        FROM
            user 
        WHERE 
            pseudo = :pseudo 
        ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
        );
    }

    public function findUserByMail($mail) {
        $sql = 
        "SELECT 
            *
        FROM
            user 
        WHERE 
            mail = :mail 
        ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }
    
}
