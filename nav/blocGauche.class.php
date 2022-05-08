<?php
// Classe créant le blocGauche
// Lié avec la feuille styleAncreArtiste.css

class BlocGauche
{
    /* ATTRIBUTS */

    private $_boitesFond1;
    private $_boitesCouleurTitre1;
    private $_boitesCouleurPolice1;
    private $_tableauArtisteTrie;



    /* METHODES */

    // Construction de attributs de l'objet
    public function __construct($boitesFond1, $boitesCouleurTitre1, $boitesCouleurPolice1, $tableauArtisteTrie){
        $this->_boitesFond1 = $boitesFond1;
        $this->_boitesCouleurTitre1 = $boitesCouleurTitre1;
        $this->_boitesCouleurPolice1 = $boitesCouleurPolice1;
        $this->_tableauArtisteTrie = $tableauArtisteTrie;
    }



    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){

        // On écrit les instruction html
        echo "<div class=\"draggableBox\">";
            echo "<nav class=\"general_fenetreLiensArtistes $this->_boitesFond1 texteNonSelectionnable\">";                //Fenetre
                echo "<div class=\"general_titreLiensArtistes\"><a class=\"$this->_boitesCouleurTitre1\"href=\"#ancreRepositionFenetreArtiste\">Artistes</a></div>";           //Titre
                echo "<ul class=\"liensArtistes\">";                                    //Liens

                    foreach($this->_tableauArtisteTrie as $artiste) {
                        echo "<li><a ><span class=\"$this->_boitesCouleurPolice1\">$artiste</span></a></li>"; // Bizarement c'est la couleur qui "translate" et pas le texte
                    }

                echo "</ul>";
            echo "</nav>";
        echo "</div>";
    }  


}
?>
