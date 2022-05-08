<?php
// Nécéssite l'appel d'un session_start() avant l'utilisation des sessions !!!

class Session
{
    private $_sessionActive;
    private $_pseudo;
    private $_motDePasse;


    // Creation du profil
    public function __construct() {
        $this->_sessionActive = 0;
        $this->_pseudo = "";
        $this->_motDePasse = "";
    }
    
    public function creationSession(){
        if((isset($_SESSION['pseudo']) && isset($_SESSION['motDePasse'])) || isset($_SESSION['sessionActive'])){
            // Cas où l'utilisateur a déja rentré ses infos
            if((isset($_SESSION['pseudo']) && isset($_SESSION['sessionActive'])) && $_SESSION['sessionActive'] == 1){
                $this->connexion(htmlspecialchars($_SESSION['pseudo']));
            }
            // Cas où il se connecte
            else if(isset($_SESSION['pseudo']) && isset($_SESSION['motDePasse'])){
                $this->verificationLogin(htmlspecialchars($_SESSION['pseudo']), htmlspecialchars($_SESSION['motDePasse']));
            }
            // Cas où la connexion n'a pas été activée
            else{
                //nothing
            }
        }
        else{
            //nothing
        }
    }
    public function verificationLogin($pseudo, $motDePasse){
        if(!strcmp($pseudo, "tintin") && !strcmp($motDePasse, "manu") || !strcmp($pseudo, "AGO") && !strcmp($motDePasse, "triathlon"))
        {
            $this->_pseudo = $pseudo;
            $this->_sessionActive = 1;
            $_SESSION['sessionActive'] = 1;
        }
        else
        {
            $this->_pseudo = $pseudo;
            $this->_sessionActive = 0;
            $_SESSION['sessionActive'] = 0;
        }
    }  
    public function connexion($pseudo){
        if(!strcmp($pseudo, "tintin"))
        {
            $this->_pseudo = $pseudo;
            $this->_sessionActive = 1;
            $_SESSION['sessionActive'] = 1;
        }
        else
        {
            $this->_pseudo = $pseudo;
            $this->_sessionActive = 0;
            $_SESSION['sessionActive'] = 0;
        }
    } 
    
    // Dbg
    public function afficheSession(){
        echo "pseudo : $this->_pseudo<br/>";
        echo "mdp : $this->_motDePasse<br/>";
        echo "sessionActive : $this->_sessionActive<br/>";
    }
    
    // Getters
    public function isSessionActive() {return $this->_sessionActive;}
    public function getPseudo() {return $this->_pseudo;}
}
?>