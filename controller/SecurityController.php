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

    public function register() {

        if (isset($_POST["submit"])) {
            $userManager = new UserManager(); 
    
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasseAgain = filter_input(INPUT_POST, "motDePasseAgain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $inscriptionDate = new \DateTime();
            $formattedInscriptionDate = $inscriptionDate->format('Y-m-d H:i:s');
            
            // Vérification des données du formulaire
            if ($pseudo && $mail && $motDePasse && ($motDePasse === $motDePasseAgain)) {
                // Définition du rôle de l'utilisateur
                $role = json_encode(["ROLE_USER"]);
    
                // Hashage du mot de passe
                $hashedMotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
    
                // Création des données pour l'ajout de l'utilisateur
                $data = [
                    "pseudo" => $pseudo,
                    "mail" => $mail,
                    "motDePasse" => $hashedMotDePasse,
                    "role" => $role,
                    "inscriptionDate" => $formattedInscriptionDate
                ];
    
                // Ajout de l'utilisateur
                $success = $userManager->add($data);
    
                if ($success) {
                    $this->redirectTo("home");
                } else {
                    // Gérer les erreurs
                    $error = "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
                }
            }
        }
    }
    

    public function loginForm () {

        return [
            "view" => VIEW_DIR."security/login.php",
            "data" => [
                "title" => "login"
            ],
            "meta" => "Connect to your account"
        ];
    }

    public function login () {
        if (isset($_POST["submit"])) {
            $userManager = new UserManager(); 
    
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
            // Vérification des données du formulaire
            if ($pseudo && $motDePasse) {
                $user = $userManager->findUser($pseudo);

                if($user) {
                    // Vérification du mot de passe
                    $verifMotDePasse = $user->getMotDePasse();
                    $success = password_verify($motDePasse, $verifMotDePasse);
                    // var_dump($success);die;
                    if ($success) {
                        // Authentification réussie, enregistrement de l'utilisateur dans la session
                        Session::setUser($user);
                        // Redirection vers la page d'accueil
                        $this->redirectTo("home");

                    } else {
                        // Gérer les erreurs
                        $error = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                    }

                } else {
                    // Gérer les erreurs
                    $error = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                }

            } else {
                // Gérer les erreurs
                $error = "Veuillez saisir votre nom d'utilisateur et votre mot de passe.";
            }

        }  
    
        return [
            "view" => VIEW_DIR."home.php",
            "data" => [
                "title" => ""
            ],
            "meta" => ""
        ];
    }
    

    public function logout () {
          // get [user] out of SESSION, disconnecting him
          unset($_SESSION["user"]);

          $this->redirectTo("home", "index");
    }


    // public function newMdpForm() {

    //     return [
    //         "view" => VIEW_DIR."security/newMotDePasse.php",
    //         "data" => [
    //             "title" => "Change password"
    //         ],
    //         "meta" => "change the password of an account"
    //     ];
    // }

    // public function newMdp() { 

    //     $userManager = new UserManager;
    //     if (isset($_POST["submit"])) {

    //         $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    //         $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //         $motDePasseAgain = filter_input(INPUT_POST, "motDePasseAgain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //         $hashedMotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT)
    //         $user = $userManager->findUser($mail);
    //         $user->setPassword($hashedMotDePasse);

    //         $data = [
    //             "id" => $user->getId(),
    //             "password" => $hashedPassword
    //         ];

    //         $userManager->update($data);

    //         $this->redirectTo("security", "login");
    //     }
    // }

  



}