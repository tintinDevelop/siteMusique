

<?php

class FicheArtiste
{
    /*
        ATTRIBUTS
    */
    
private $_nom;
private $_nomSansEspace;
private $_tableauNomsMusiques;
private $_tableauLiensMusiques;
private $_style;

private $_colonneGauche;
private $_colonneDroite;

private $_theme;


    
    /*
        METHODES
    */
    
public function __construct($nom,$tableauNomsMusiques,$tableauLiens,$style,$theme){
    $this->_nom = $nom;
    $this->_tableauNomsMusiques = $tableauNomsMusiques;
    $this->_tableauLiensMusiques = $tableauLiens;
    $this->_style = $style;
    $this->_theme = $theme;

    // On divise en deux bloc equitable les musiques de l'artiste 
    $this->_colonneGauche = ceil(count($tableauNomsMusiques) / 2);
    $this->_colonneDroite = count($tableauNomsMusiques) - $this->_colonneGauche;

    // On supprime les espace de la chaine de caractere pour pouvoir utiliser les div "speciaux"
    $this->_nomSansEspace = str_replace(" ", "",$this->_nom);
    $this->_nomSansEspace = str_replace(".", "",$this->_nomSansEspace); // On enleve aussi les "." ex: B.O.B 
}


public function getNom() {return $this->_nom;}
public function getNomSansEspace() {return $this->_nomSansEspace;}
public function getTableauNomsMusiques() {return $this->_tableauNomsMusiques;}
public function getTableauLiensMusiques() {return $this->_tableauLiensMusiques;}
public function getStyle() {return $this->_style;}
public function getColonneGauche() {return $this->_colonneGauche;}
public function getColonneDroite() {return $this->_colonneDroite;}



public function afficheLiensColonneGauche(){
    for($i = 0; $i < count($this->_tableauNomsMusiques); $i=$i+2) {
        // On a mis le lien youtube dans un span après le nom de la musique, comme ça on peut le récupérer facilement
        echo "<a id='lienChoixPlayer' class='policeLiensMusiques$this->_theme'><span class=\"translationMusique\">" . $this->_tableauNomsMusiques[$i] . "</span></a><span style='display:none;'>" . $this->_tableauLiensMusiques[$i] . "</span></br>" ;
    }
}
public function afficheLiensColonneDroite(){
    for($i = 1; $i < count($this->_tableauNomsMusiques); $i=$i+2) {
        // On a mis le lien youtube dans un span après le nom de la musique, comme ça on peut le récupérer facilement
        echo "<a id='lienChoixPlayer' class='policeLiensMusiques$this->_theme'><span class=\"translationMusique\">" . $this->_tableauNomsMusiques[$i] . "</span></a><span style='display:none;'>" . $this->_tableauLiensMusiques[$i] . "</span></br>" ;    
    }
}


}//Fin de la classe FICHEARTISTE



?>








