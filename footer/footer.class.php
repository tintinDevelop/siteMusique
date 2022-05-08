<?php
// Classe créant le footer
// Lié avec la feuille styleFooter.css

class Footer
{
    /* ATTRIBUTS */

    private $_theme;
    private $_bordureGeneralCouleur;
    private $_footer_couleurTitre;
    private $_footer_couleurPoliceCellule;
    


    /* METHODES */

    // Construction de attributs de l'objet
    public function __construct($theme, $bordureGeneralCouleur, $footer_couleurTitre, $footer_couleurPoliceCellule){
        $this->_theme = $theme;
        $this->_bordureGeneralCouleur = $bordureGeneralCouleur;
        $this->_footer_couleurTitre = $footer_couleurTitre;
        $this->_footer_couleurPoliceCellule = $footer_couleurPoliceCellule;
    }

    // Definition des fonction créant les fenetres du footer
    public function footer_Fenetre_ouverture($titrePartie1, $titrePartie2, $titrePartie3){
        $titreReggaeOuNon = "";
        if(!strcmp($this->_theme,"Reggae")){
            $titreReggaeOuNon = "<span class=\"couleurVert\">$titrePartie1</span><span class=\"couleurJaune\">$titrePartie2</span><span class=\"couleurRouge\">$titrePartie3</span>";                     
        }else {
            $titreReggaeOuNon = "$titrePartie1$titrePartie2$titrePartie3"; 
        }

        echo "<div class=\"celluleFooter\">";
        echo"<div class=\"titreFooter $this->_footer_couleurTitre policeKaushan \">$titreReggaeOuNon</div>"; 

    }  
    public function footer_Fenetre_fermeture(){
        echo "</div>";
    }

    
    
    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){
        // On défini tt d'abord le contenant du bloc droit
        echo"<footer class=\"fondNoir $this->_bordureGeneralCouleur\">";


            // Bloc 1: LIENS RADIOS
            $this->footer_Fenetre_ouverture("Lien", "s Ra", "dio");
                $this->liensRadios();
            $this->footer_Fenetre_fermeture();


            // bloc 2: NOUVELLES MUSIQUES AJOUTEES
            $this->footer_Fenetre_ouverture("Nouve", "lles Mus", "iques");
                $this->dernieresMusiquesAjoutees();
            $this->footer_Fenetre_fermeture();


            // bloc 3: CONTACT
            $this->footer_Fenetre_ouverture("Me C", "onta", "cter");
                $this->contact();
            $this->footer_Fenetre_fermeture();


        echo "</footer>";
    }  



    
    //======= 1. LIENS RADIOS =======
    public function liensRadios(){
        echo "<p class=\"liensRadio1\">";                                                 
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.lemouv.fr/\" target=\"_blank\"><b>Le Mouv'</b><br/>";    
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.nostalgie.fr/\" target=\"_blank\"><b>Nostalgie</b></a><br/>";
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.nrj.fr/\" target=\"_blank\"><b>NRJ</b></a><br/>";
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.radiofg.com/\" target=\"_blank\"><b>Radio FG</b></a><br/>";        
            echo "<br/>";
        echo "</p>";

        echo "<p class=\"liensRadio2\">";                                                 
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.virginradio.fr/\" target=\"_blank\"><b>Virgin Radio</b><br/>";    
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.radiomeuh.com/ecouter\" target=\"_blank\"><b>Radio Meuh</b></a><br/>";
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.chantefrance.com/\" target=\"_blank\"><b>Chante France</b></a><br/>";
            echo "<a class=\"$this->_footer_couleurPoliceCellule\" href=\"http://www.generationsfm.com/\" target=\"_blank\"><b>Generations 88.2</b></a><br/>";        
            echo "<br/>";
        echo "</p>";
    }

    //======= 2. NOUVELLES MUSIQUES =======
    public function dernieresMusiquesAjoutees(){
        echo "<div class=\"listeDerniersArtistes policeKaushan $this->_footer_couleurPoliceCellule\">";
            include("listeDerniersArtistesAjoutes.php"); 
        echo "</div>";
    }  

    //======= 3. CONTACT =======
    public function contact(){
        echo "<p class=\"liensContact $this->_footer_couleurPoliceCellule\">";   
            echo "<br />";
            //                echo "Facebook : <a class=\"$footer_couleurPoliceCellule\" href =\"https://www.facebook.com/thomas.letraon\" target=\"_blank\">Thomas Le Traon</a> <br/>"; 
            echo "Email : <a class=\"$this->_footer_couleurPoliceCellule\" href=\"mailto:letraon.thomas@gmail.com\">letraon.thomas@gmail.com</a> <br/>"; 
            //                echo "Snapchat : tomtom_77240 <br/>"; 
        echo "</p>";

    }  

  



}
?>
