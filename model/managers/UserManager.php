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

      /**
         * return every email in the database, is used during the registration to be sure that the email isn't already used
         */
        public function findEveryMail() {
            $sql = 
            "SELECT 
                mail
            FROM
                user 
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        /**
         * return every username in the database, used for the same reason as above (username are also unique)
         */
        public function findEveryUsername() {
            $sql = 
            "SELECT 
                pseudo
            FROM
                user
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
    
}
