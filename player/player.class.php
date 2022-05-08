<?php
// Classe créant le lecteur vidéo

class Player
{
    private $_affichageFenetre;
    private $_affichagePlayerOuLL;
    private $_theme;
    private $_boitFond1;
    private $_musiqueEnCours;
    private $_parametresFenetrePrincipale;


    // Creation du profil
    public function __construct($theme, $boiteFond1) {
        $this->_affichageFenetre = 1;
//        $this->_affichagePlayerOuLL = "player";
        $this->_affichagePlayerOuLL = "player";
        $this->_theme = $theme;
        $this->_boiteFond1 = $boiteFond1;
//        $this->_musiqueEnCours = ""; // non utilisé pour l'instant
    }
    
    public function player_Fenetre_ouverture(){
        $display = ($this->_affichageFenetre == 1) ? 'block' : 'none';
        
        echo "<div class='player_fenetre $this->_boiteFond1' style='display:$display;'>";
            echo "<h1 class='player_boiteTitre player_titre$this->_theme'>Player</h1>";
        
    }
    public function player_Fenetre_fermeture(){
        echo "</div>";
    }
    
    
    
    
    public function creationFenetre(){
        $this->player_Fenetre_ouverture();
            $this->video();
            $this->listeLecture();
            $this->boutonAfficheListeLecture();
        $this->player_Fenetre_fermeture();

    } 
    
    
    //======= 1. Video =======
//    public function video(){
//        $display = (!strcmp($this->_affichagePlayerOuLL, 'player')) ? 'block' : 'none';
//        $display = "block";
//        echo "<div class='player_fenetreVideo' style='height:$display;'>";
//            // On n'a pas écrit l'attribut 'src' car sinon on a le msg ".. video not found"
//            echo "<iframe width='100%' height='100%' frameborder='0' allowfullscreen></iframe>";
//        echo "</div>";
//    }
    
    public function video(){
        $display = (!strcmp($this->_affichagePlayerOuLL, 'player')) ? 'block' : 'none';
        $display = "block";
        echo "<div class='player_fenetreVideo' style='height:$display;'>";
            // On n'a pas écrit l'attribut 'src' car sinon on a le msg ".. video not found"
//            echo "<iframe width='100%' height='100%' frameborder='0' allowfullscreen></iframe>";
            echo "<div id='player_scriptVideo'></div>";
        
        echo "</div>";
        
        
        
        
    }
  

    
    //======= 2. Liste lecture =======
    public function listeLecture(){
        $display = (!strcmp($this->_affichagePlayerOuLL, 'LL')) ? 'block' : 'none';
        $couleurLigne = '';
        
        echo "<div class='player_fenetreListeLecture' style='display:$display;'>";
            echo "<div class='fenetreListeLecture_boite'>";
        
                for($i=0; $i < 10; $i++){
                    $couleurLigne = ($i%2 == 1) ? 'couleurLigne1' : 'couleurLigne2';
                   
                    echo "<div class='ligneListeLecture $couleurLigne'>";
//                        echo ($i+1) . " Titre - Artiste";
                        echo "<a href='' ></a>";
//                        echo "<p>Aucun</p>";
                    echo "</div>";
                }
        
                
        
            echo "</div>";
        echo "</div>";
        
    }
    public function boutonAfficheListeLecture(){
        echo "<div class='boiteBoutonAffichPlayerOuLL'>";
            echo "<a class='btn' style='cursor: pointer;'>Liste de Lecture</a>";
        echo "</div>";

    }
 
    
    
    // Getters
    public function isFenetreAffichee() {return $this->_affichageFenetre;}
    public function getMusiqueEnCours() {return $this->_musiqueEnCours;}
}
?>