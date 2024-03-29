<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\UserManager;

class SecurityController extends AbstractController {
    // contiendra les méthodes liées à l'authentification : register, login et logout


    public function index () {

    
    }
    public function registerForm() {
       
        return [
            "view" => VIEW_DIR."security/register.php",
            "data" => [
                "meta_description" => "Formulaire d'inscription."
            ],
        ];
    }

    public function register() {

        if (isset($_POST["submit"])) {
            $userManager = new UserManager(); 
    
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasseAgain = filter_input(INPUT_POST, "motDePasseAgain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $inscriptionDate = new \DateTime();
            // $formattedInscriptionDate = $inscriptionDate->format('Y-m-d H:i:s');

            $errorCheck = false; // wil become true is there is any problems in any form
            
            // regex: needs at least 1 capital, 1 small, 1 number, 1 special char and 4 characters in total 
            //(the CNIL advise around 12 to be actually safe)
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/";

            // check that all inputs were completed
            if(empty($pseudo)) {
                Session::addFlash("pseudo", "This field is mandatory!");
                $errorCheck = true;
            }

            if(empty($mail)) {
                Session::addFlash("mail", "This field is mandatory!");
                $errorCheck = true;
            }


            if(empty($motDePasse)) {
                Session::addFlash("motDePasse", "This field is mandatory!");
                $errorCheck = true;
            }

            if(empty($motDePasseAgain)) {
                Session::addFlash("motDePasseAgain", "This field is mandatory!");
                $errorCheck = true;
            }

            // check regex password
            if(!preg_match($password_regex, $motDePasse)) {
                Session::addFlash("motDePasse", "this password isn't safe!");
                $errorCheck = true;
            }

            if($motDePasse !== $motDePasseAgain) {
                Session::addFlash("motDePasseAgain", "The passwords are not the same");
                $errorCheck = true;
            }

            // check if username and email aren't already used (both are unique)
            $pseudos = $userManager->findEveryUsername();
            $mails = $userManager->findEveryMail();

            foreach($pseudos as $pseudoDatabase) {
                if($pseudoDatabase->getPseudo() === $pseudo) {
                    Session::addFlash("pseudo", "Username is invalid or already in use");
                    $errorCheck = true;
                }
            }

            foreach($mails as $mailsDatabase) {
                if($mailsDatabase->getMail() === $mail) {
                    Session::addFlash("mail", "Email is invalid or already in use");
                    $errorCheck = true;
                }
            }

            if (!$errorCheck) {  
            // Vérification des données du formulaire
                if ($pseudo && $mail && $motDePasse && ($motDePasse === $motDePasseAgain)) {
                    // Définition du rôle de l'utilisateur
                    $role = json_encode("[ROLE_USER]");
        
                    // Hashage du mot de passe
                    $hashedMotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
        
                    // Création des données pour l'ajout de l'utilisateur
                    $data = [
                        "pseudo" => $pseudo,
                        "mail" => $mail,
                        "motDePasse" => $hashedMotDePasse,
                        "role" => $role
                        // "inscriptionDate" => $formattedInscriptionDate
                    ];
        
                    // Ajout de l'utilisateur
                    $success = $userManager->add($data);
        
                    if ($success) {
                        $this->redirectTo("security", "login");
                        return [
                            "view" => VIEW_DIR."security/login.php",
                            "data" => [
                                "meta_description" => "inscription ok."
                            ],
                        ];
                    } else {
                        // Gérer les erreurs
                        $error = "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
                    }

                } else { // mistake(s) were made in some of the input 
                    $this->redirectTo("security", "register");
                    return [
                        "view" => VIEW_DIR."security/register.php",
                        "data" => [
                            "meta_description" => "Register"
                        ],
                    ];
                }
            }
        }
    }
    

    public function loginForm () {

        return [
            "view" => VIEW_DIR."security/login.php",
            "data" => [
                "meta_description" => "Formulaire de connexion."
            ],
        ];
    }

    public function login () {
        
        if (isset($_POST["submit"])) {
            $userManager = new UserManager(); 
    
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
            // Vérification des données du formulaire
            if ($pseudo && $motDePasse) {
                $user = $userManager->findUserByPseudo($pseudo);

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
                        return [
                            "view" => VIEW_DIR."home",
                            "data" => [
                                "meta_description" => "Connexion ok."
                            ],
                        ];

                    } else {
                        // Gérer les erreurs
                        Session::addFlash("error", "Le nom d'utilisateur ou le mot de passe est incorrect.");
                    }

                } else {
                    // Gérer les erreurs
                    Session::addFlash("error", "Utilisateur inconnu");
                }

            } else {
                // Gérer les erreurs
                Session::addFlash("error", "Veuillez remplir tous les champs");
            }

        }  
    
        return [
            "view" => VIEW_DIR."security/login.php",
            "data" => [
                "meta_description" => "Formulaire de connexion."
            ],
        ];
    }
    

    public function logout () {
          // get [user] out of SESSION, disconnecting him
          unset($_SESSION["user"]);

          $this->redirectTo("home", "index");
          return [
            "view" => VIEW_DIR."home",
            "data" => [
                "meta_description" => "Deconnexion ok."
            ],
        ];
    }


    public function newMdpForm() {
        
            return [
                "view" => VIEW_DIR."security/newMdp.php",
                "data" => [
                    "title" => "Change password",
                    "meta_description" => "change the password of an account"
                ],
            ];
        
    }

    public function newMdp() { 

        if (isset($_POST["submit"])) {
            $userManager = new UserManager;
    
            // Validation des données du formulaire
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
            $oldMotDePasse = filter_input(INPUT_POST, "oldMotDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $NewMotDePasse = filter_input(INPUT_POST, "NewMotDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $NewMotDePasseAgain = filter_input(INPUT_POST, "NewMotDePasseAgain", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if (!empty($mail) 
             && !empty($oldMotDePasse) 
             && !empty($NewMotDePasse) 
             && !empty($NewMotDePasseAgain)
             && ($NewMotDePasse === $NewMotDePasseAgain)) {

                // Récupération de l'utilisateur par email
                $user = $userManager->findUserByMail($mail);
                $verifMotDePasse = $user->getMotDePasse();
                $success = password_verify($oldMotDePasse, $verifMotDePasse);
                // var_dump($success);die;
                
                if ($user && $success) {
                    // Hachage du nouveau mot de passe
                    $hashedNewMotDePasse = password_hash($NewMotDePasse, PASSWORD_DEFAULT);
    
                    // Mise à jour du mot de passe de l'utilisateur
                    $user->setMotDePasse($hashedNewMotDePasse);

                    $data = [
                        "id" => $user->getId(),
                        "motDePasse" => $hashedNewMotDePasse
                    ];
    
                    $userManager->update($data);
    
                    // Redirection vers la page de connexion
                    $this->redirectTo("security", "login");

                } else {
                    // Utilisateur introuvable ou mot de passe incorrect
                    $error = "Utilisateur introuvable ou mot de passe incorrect.";
                }

            } else {
                // Les champs sont vides ou les mots de passe ne correspondent pas
                $error = "Veuillez saisir des données valides et assurez-vous que les mots de passe correspondent.";
            }

            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => [
                    
                    "meta_description" => "Change Password ok."
                ],
            ];
        }  
        
    }

    public function updateUserForm($id) {

        if(Session::getUser()){

        if ((Session::isAdmin()) 
         || (Session::getUser()->getId() == $id)) {
                $userManager = new userManager;
                $user = $userManager->findOneById($id);
                
                return [
                    "view" => VIEW_DIR."forum/usr/updateUser.php",
                    "data" => [
                        "title" => "user update",
                        "user" => $user,
                        "meta_description" => "update an existing account."
                    ],
                ];
            } else {
                Session::addFlash('stop', "Pas touche aux comptes qui t'appartiennent pas.");
                return [
                    "view" => VIEW_DIR."security/stop.php",
                    "data" => [
                    "meta_description" => "hmmmmmm you're not supposed to be here."
                    ],
                ];
            }
        } else {
            return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Update an existing account ok."
            ];
        }
    }

    public function updateUser($id) {
         
        $userManager = new userManager();
        $user = $userManager->findOneById($id);
    
        if (isset($_POST["submit"])) {

            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);

        
            if(isset($_FILES['profilePic'])){

                $tmpName = $_FILES['profilePic']['tmp_name'];
                $name = $_FILES['profilePic']['name'];
                $size = $_FILES['profilePic']['size'];
                $error = $_FILES['profilePic']['error'];
                
                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));
                
                //Tableau des extensions que l'on accepte
                $extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
                $maxSize = 1200000;
                
                if(in_array($extension, $extensions) && $size <= $maxSize){
                    $uniqueName = uniqid('', true);
                    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                    $profilePic = $uniqueName.".".$extension;
                    //$file = 5f586bf96dcd38.73540086.jpg
                    move_uploaded_file($tmpName, 'public/img/uploads/'.$profilePic);  
                }
            }

            $data = [
                "id" => $id,
                "pseudo" => $pseudo,
                "mail" => $mail,
                "profilePic" => $profilePic
            ];

            $success = $userManager->update($data);
            
            if ($success) {
                // Rediriger l'utilisateur vers la page du topic
                // $this->redirectTo("user", "detailsUser", $id);
                return [
                    "view" => VIEW_DIR."forum/usr/detailsUser.php",
                    "data" => [
                        "user" => $user,
                        "meta_description" => "Update profile ok."
                    ],
                   
                ];
            } else {
                // Gérer les erreurs
                return [
                    "view" => VIEW_DIR."forum/usr/updateUser.php",
                    "data" => [
                        "user" => $user,
                        "meta_description" => "Update profile fail."
                    ],
                ];
                echo "Une erreur s'est produite lors de la mise à jour de la photo.";
            }
        }
    }

    public function deleteUser($id) {

        if (Session::isAdmin()) {

            $userManager = new UserManager();
            $users = $userManager->findAll();
            $user = $userManager->findOneById($id);

            // var_dump($user);die;

            if ($user) {

                $data = [
                    "id" => $id,
                "pseudo" => "deleted_user",
                "mail" => "null",
                "motDePasse" => "null",
                "profilePic" => "deleted_user.webp"
                ];

                $userManager->update($data);
                $this->redirectTo("usr", "listUsers");
                return [
                    "view" => VIEW_DIR."forum/usr/listUsers.php",
                    "data" => [
                        "meta_description" => "Suppression du compte : ".$user,
                        "users" => $users
                    ],
                ];
            }
        } else {
            Session::addFlash("stop", "petit fouineur lol t'as rien à faire ici");

            return [
                "view" => VIEW_DIR."security/stop.php",
                "data" => [
                "meta_description" => "hmmmmmm you're not supposed to be here."
                ],
            ];
        }
    }


}
    
        





