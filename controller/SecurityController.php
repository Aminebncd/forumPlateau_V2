<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout


    public function index () {

    
    }
    public function registerForm() {
       
        return [
            "view" => VIEW_DIR."security/register.php",
            "data" => [
                "title" => "Register"
            ],
            "meta" => "Form to create an account"
        ];
    }

    public function register () {

        if (isset($_POST["submit"])) {
            
            $userManager = new UserManager(); 
                        
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasseAgain = filter_input(INPUT_POST, "motDePasseAgain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $inscriptionDate = new \DateTime();
                $formattedInscriptionDate = $inscriptionDate->format('Y-m-d H:i:s');
            
            if ($pseudo && $mail && $motDePasse && ($motDePasse === $motDePasseAgain)) {
                $data = [
                    "pseudo" => $pseudo,
                    "mail" => $mail,
                    "motDePasse" => password_hash($motDePasse, PASSWORD_DEFAULT),
                    "inscriptionDate" => $formattedInscriptionDate
                ];

                // var_dump($data['motDePasse']); 

                $success = $userManager->add($data);
        
                if ($success) {
                    $this->redirectTo();
                } else {
                    // Gérer les erreurs
                    $error = "Une erreur s'est produite lors de l'ajout du sujet.";
                }
                
            }

        }
    }

    public function login () {

    }

    public function logout () {

    }
    
}