<?php
// Classe créant la banniere
// Lié avec la feuille styleBanniere.css

class Banniere
{
    /* ATTRIBUTS */

    private $_bdd;
    private $_theme;
    private $_tab;
    private $_bordureGeneralCouleur;
    private $_couleurTitreFenetreNewsEtChoixStyle;



    /* METHODES */

    // Construction de attributs de l'objet
    public function __construct($bdd, $theme, $tab, $bordureGeneralCouleur, $couleurTitreFenetreNewsEtChoixStyle){
        $this->_bdd = $bdd;
        $this->_theme = $theme;
        $this->_tab = $tab;
        $this->_bordureGeneralCouleur = $bordureGeneralCouleur;
        $this->_couleurTitreFenetreNewsEtChoixStyle = $couleurTitreFenetreNewsEtChoixStyle;
    }
    
    

    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){
        
        // BANNIERE
        $this->banniere();
        
        
        echo "<div class='blocNews' style='height: 615px;'>";
            
//            // NEWSLETTER
//            $this->blocSousBanniere_Fenetre_ouverture("newsletter", "fenetreBillets", "Ne", "wsle", "tter");         
//                $this->Newsletter();         
//            $this->blocSousBanniere_Fenetre_fermeture();


            // CHOIX STYLES
            $this->blocSousBanniere_Fenetre_ouverture("choixStyle", "fenetreBoutons", "Sélec", "tion ", "Styles");
                $this->BoutonChoixStyles();  
            $this->blocSousBanniere_Fenetre_fermeture();
        
        echo "</div>";
    }  


    //======= 1. BANNIERE =======
    public function banniere(){
        // BLOC AU DESSUS DE LA BANNIERE
        echo "<div class='blocSurBanniere '>";
        echo "</div>";
        
        
        //BANNIERE
        echo "<div class='general_banniereImage $this->_bordureGeneralCouleur bordure15px fondNoir' >"; 
            echo "<div id='descriptionBanniere'>";
                echo "La musique exprime ce qui ne peut être dit et sur quoi il est impossible de rester silencieux. <span class='auteurCitation'>(Victor Hugo)</span>";
            echo "</div>";
        echo "</div>";
        
        
        // BLOC AU DESSOUS DE LA BANNIERE 
        echo "<div class='blocSousBanniere'>";
        echo "</div>";
    }
    
    public function blocSousBanniere_Fenetre_ouverture($nomFenetre, $nomBloc, $themePartie1, $themePartie2, $themePartie3){
        $titreAvecStyleReggaeOuNon = "";
        if(!strcmp($this->_theme,"Reggae")){
            $titreAvecStyleReggaeOuNon = "<span class='couleurVert'>$themePartie1</span><span class='couleurJaune'>$themePartie2</span><span class='couleurRouge'>$themePartie3</span>";                     
        }else {
            $titreAvecStyleReggaeOuNon = "$themePartie1$themePartie2$themePartie3";                     
        }

        echo "<div class='fntrNewsEtChoixStyle fntrNewsEtChoixStyle_$nomFenetre $this->_bordureGeneralCouleur fondNoir texteNonSelectionnable'>";        
        echo "<div class='titreFntrNewsEtChoixStyle $this->_couleurTitreFenetreNewsEtChoixStyle'>$titreAvecStyleReggaeOuNon</div>";                     
            echo "<div class='visibilite' style='height:0px;visibility:hidden'>";
                echo "<div class='$nomBloc'>";    
    }
    public function blocSousBanniere_Fenetre_fermeture(){
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    //======= 2. NEWSLETTER =======
    public function Newsletter(){

        $reponse = $this->_bdd->query('SELECT ID,titre,contenu,DATE_FORMAT(date_creation, \'%d-%m-%y à %Hh%i\') AS date_creation FROM billets ORDER BY ID DESC');

        while ($donnees = $reponse->fetch()) {
            $ID = $donnees['ID'];
            $titre = $donnees['titre'];
            $contenu = nl2br(htmlentities($donnees['contenu']));
            $date_creation = $donnees['date_creation'];


            $compteurCommentaire = $this->_bdd->prepare('SELECT COUNT(*) AS nombreComm FROM commentaires WHERE ID_billet = ?');
            $compteurCommentaire->execute(array($ID));
            $donneeCompteur = $compteurCommentaire->fetch();
            $nombre = $donneeCompteur['nombreComm'];
            $compteurCommentaire->closeCursor();


            echo "<div class='blocTitreCommNewsletter '>$titre &nbsp;&nbsp;&nbsp; $date_creation</div>";
                echo "<div class='blocContenuCommNewsletter '>$contenu<br />";
                    echo "<a href='commentaires/commentaires.php?ID=$ID' class='lienCommNewsletter'>$nombre Commentaires</a>";
                echo "</div>";
        } 
        $reponse->closeCursor();
    }
    
    //======= 3. CHOIX STYLES =======
    public function BoutonChoixStyles(){

        echo "<br/>";
        echo "<form action='html07.php' method='post'>";
            echo "<div class='bandeauStyle'>";

                echo "<div class='bandeauStyle_caseStyle'>";
                    echo "<div class='bandeauStyle_caseTitreStyle'><span class='bandeauStyle_titreStyle'>All</span></div>"; 
                    echo "<div class='bandeauStyle_bouton'>";
                        echo "<div class='bouton'>"; 
                            echo "<div class='slideThree'>";	
                                echo "<input type='checkbox' name='style1' value='All' id='All' name='check' /> <label for='All'></label>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";

            //On parcourt le tableau contenant les différents style de la bdd pour créer les bouton de filtre des styles
            for($k=0; $k < count($this->_tab); $k++) {
                $j = $k + 2;
                $styleName = $this->_tab[$k];
                
                echo "<div class='bandeauStyle_caseStyle'>";
                    echo "<div class='bandeauStyle_caseTitreStyle'><span class='bandeauStyle_titreStyle'>" . $this->_tab[$k] . "</span></div>"; 
                    echo "<div class='bandeauStyle_bouton'>";
                        echo "<div class='bouton'>";
                            echo "<div class='slideThree'>";  // Style2, Style3..   Rock, Rap..
                                echo "<input type='checkbox' name='style$j' value='$styleName' id='$styleName' name='check' /> <label for='$styleName'></label>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            echo "</div>";

            // Bouton Valider 
            echo "<div id='button'>";
                echo "<input type='submit' class='butt' value='GO'/>";
            echo "</div>";
        echo "</form>";
    }
}
?>
