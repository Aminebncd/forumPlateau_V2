<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $pseudo;
    private $mail;
    private $motDePasse;
    private $role;
    private $inscriptionDate;
    private $profilePic;


    public function __construct($data){         
        $this->hydrate($data);        
    }

      
    public function getId(){
        return $this->id;
    }

    
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    
    public function getPseudo(){
        return $this->pseudo;
    }

    
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;

        return $this;
    }

    
    public function getMail()
    {
        return $this->mail;
    }

    
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }
     

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }
    
    
    public function setmMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }


    public function getRole()
    {
        return $this->role;
    }
    
    
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    // public function getFormattedDate($format) {
    //     return $this->inscriptionDate->format($format);
    // }


    public function getInscriptionDate(){
        $formattedDate = $this->inscriptionDate;
        return $formattedDate;
    }    


    public function setInscriptionDate($date){
        $this->inscriptionDate = new \DateTime($date);
        return $this;
    }

    
    public function getProfilePic()
    {
        return $this->profilePic;
    }


    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    public function showProfilePicture() {
        $picture = $this->getProfilePic();
        
        
        echo "
        <figure>
            <img src='./public/img/uploads/$picture' alt='$picture' class='profileImg'>
        </figure>
        ";
    }
    
    public function __toString() {
        return $this->pseudo;
    }



}