<?php
// Classe créant le header
// Lié avec la feuille styleHeader.css

class Header
{
    /* ATTRIBUTS */

    private $_theme;
    private $_bordureGeneralCouleur;
    private $_couleurTitrePrincipal;
    private $_session_pseudo;
   
    

    /* METHODES */

    // Construction de attributs de l'objet
    public function __construct($theme, $bordureGeneralCouleur, $couleurTitrePrincipal, $session_pseudo){
        $this->_theme = $theme;
        $this->_bordureGeneralCouleur = $bordureGeneralCouleur;
        $this->_couleurTitrePrincipal = $couleurTitrePrincipal;
        $this->_session_pseudo = $session_pseudo;
    }
    
    public function header_Fenetre_ouverture(){
        echo "<header class='$this->_bordureGeneralCouleur' style='height: 150px;'>";
    }
    public function header_Fenetre_fermeture(){
        echo "</header>"; 
    }

    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){
       
        $this->header_Fenetre_ouverture();
        
        
        // Bloc 1: FENETRE CONNEXION
        $this->fenetreConnexion();
        
        // Bloc 2: HEADER
        $this->header_principal();

 
        $this->header_Fenetre_fermeture();
    }  




    //======= 1. FENETRE CONNEXION =======
    public function fenetreConnexion(){
        
        // Connexion Session : Affichage
        echo "<div class='fntrConnexion'>";
            echo "<div class='blocTitreSite $this->_couleurTitrePrincipal'><span class='posTitreFntrConnexion '>Le Mur Du Son</span></div>"; 

                $this->bandeauMasqueSessionConnexion();
        
                $this->bandeauOriginal();
        
                $this->caseProfil();

        echo "</div>";
    }
    public function bandeauMasqueSessionConnexion(){
        echo "<div class='bandeauSessionConnexion' style='width:0px; height: 0px; visibility: hidden;'>";
            echo "<div class='general_blocsCorrespondanceFormulaire blocPseudo $this->_couleurTitrePrincipal'>Pseudo</div>"; 
            echo "<div class='general_blocsCorrespondanceFormulaire blocMDP $this->_couleurTitrePrincipal'>Mot de passe</div>";
            echo "<div class='general_blocsCorrespondanceFormulaire blocInscription $this->_couleurTitrePrincipal'>Inscription</div>";

            // Connexion Session : Formulaire 
            echo "<div class='bandeauFormulaireConnexion' >";

                echo "<form action='connexion.php' method='post'>"; // TODO SESSION CONNEXION
                    echo "<input type='text' name='pseudoConnexion' class='general_blocsFormulaires inputFormulairePseudo' cols='5'/><br />";
                    echo "<input type='text' name='mdpConnexion' class='general_blocsFormulaires inputFormulaireMDP'/><br />";
                    echo "<input type='submit' value='Connexion' class='general_blocsFormulaires validationFormulaire'/>";
                echo "</form>";

            echo "</div>";
        echo "</div>";
    }
    public function bandeauOriginal(){
        echo "<div class='bandeauOriginal'>";
        
            echo "<div class='bandeauOriginal_bloc1'>";
                echo "<div class='bandeauOriginal_caseBonjour $this->_couleurTitrePrincipal'>";
                    echo "Bonjour $this->_session_pseudo !";
                echo "</div>";
            echo "</div>";
        
            echo "<div class='bandeauOriginal_bloc2'>";
                echo "<div class='bandeauOriginal_casePlayer $this->_couleurTitrePrincipal fntrConnexionCouleurBordure$this->_theme texteNonSelectionnable' >";
                    echo "Player";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    public function caseProfil(){
        // Bouton "Profil"
        echo "<div class='caseProfil $this->_couleurTitrePrincipal fntrConnexionCouleurBordure$this->_theme texteNonSelectionnable' >";
            echo "Profil";
        echo "</div>";
    }

    //======= 2. HEADER =======
    public function header_principal(){
        echo "<div class='header_blocGeneral'>";
            
        $this->header_blocGauche();
        $this->header_blocCentrale();
        $this->header_blocDroit();
        
        echo "</div>";
    }
    public function header_blocGauche(){
        echo "<div class='header_blocGauche'>";
            echo "<div class='header_image1'>";
            echo "</div>";
        echo "</div>";
    }
    public function header_blocCentrale(){
        echo "<div class='header_blocCentrale'>";
            echo "<div class='header_titrePrincipale $this->_couleurTitrePrincipal'>Le Mur Du Son</div>";   
        echo "</div>";
    }
    public function header_blocDroit(){
        echo "<div class='header_blocDroit'>";
            echo "<div class='header_image2'>";
            echo "</div>";
        echo "</div>";
    }
}
?>
