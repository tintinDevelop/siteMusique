<?php
// Classe créant l'article
// Lié avec la feuille styleSectionArtiste.css

class Article
{
    /* ATTRIBUTS */

    private $_bdd;
    private $_theme;
    private $_sessionActive;
    private $_fond1;
    private $_fond2;
    
    
    
    //Styles selectionnés
    private $_tabStylesSelect;
    private $_tabStyleNomChampFormulaire;
    
    //Tableau artistes résultant
    private $_tableauArtiste;
    private $_tableauArtisteTrie;
    private $_tableauArtisteNonTrie;
    
    // Attribut de la classe ficheArtiste
    private $_tabFichesArtistes;

    // DEBUG : Affiche la fenetre des musiques ou des choix de lectures
    private $_afficheMusiquesOuChoixPlayer = "musiques";
//    private $_afficheMusiquesOuChoixPlayer = "choixPlayer";



    /* METHODES */

    // Construction de attributs de l'objet
    public function __construct($bdd, $theme, $tabStylesSelect, $tabStyleNomChampFormulaire, $sessionActive, $fond1, $fond2){
        $this->_bdd = $bdd;
        $this->_theme = $theme;
        $this->_tabStylesSelect = $tabStylesSelect;
        $this->_tabStyleNomChampFormulaire = $tabStyleNomChampFormulaire;
        $this->_sessionActive = $sessionActive;
        $this->_fond1 = $fond1;
        $this->_fond2 = $fond2;
        
        // Remplit tableauArtisteTrie et tableauArtisteNonTrie
        $this->initTableauxArtistes();
        
        
        // Crée le tableau de fiches des artistes
        $this->initFichesArtistes();
    }
        
    
    
    public function article_Fenetre_ouverture(){
        echo "<section>";
            echo "<article class='texteNonSelectionnable'>";
        
                $artisteSansEspace = $this->_tabFichesArtistes[0]->getNomSansEspace();
                $ancreArtiste = "titre$artisteSansEspace";

                //-- ANCRE
                // On la déplace au dessus de l'article pour avoir l'article au centre de la page quand on clique sur le lien
                echo "<div class='ancreArtiste' id='ancreRepositionFenetreArtiste'></div>"; 
                echo "<div id=$ancreArtiste></div>"; 
        
                //-- FOND DE L'ARTICLE 
                echo "<div class='positionArticle backgroundArticle$this->_theme $this->_fond1 ' >";	// fond de la 1ere fenetre

    }
    public function article_Fenetre_fermeture(){
                echo "</div>";
            echo "</article>";
        echo "</section>";
    }

    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){

        $this->article_Fenetre_ouverture();


            // Bloc 1: ASIDE
            $this->aside();

            // Bloc 2: TITRE
            $this->titre();

            // Bloc 3: FENETRE LIENS MUSIQUES
            $this->fenetreLiensMusiqueOuChoixPlayer();

            // Bloc 4: BLOC BAS ARTICLE
            $this->blocBasArticle();


        $this->article_Fenetre_fermeture();
    }  




    //======= 1. ASIDE =======
    public function aside(){
        
        $artisteSansEspace = $this->_tabFichesArtistes[0]->getNomSansEspace();

        // On Construit les extensions possibles pour le lien de l'image de l'artiste
        $extension1 = "images/". lcfirst($artisteSansEspace) . ".jpg";
        $extension2 = "images/". lcfirst($artisteSansEspace) . ".jpeg";
        // Si l'image n'existe pas, on attribut l'image de base
        if(file_exists($extension1) || file_exists($extension2)){ 
            $feuilleStyleImage = "img$artisteSansEspace";   
        } else {
            $feuilleStyleImage = "imgOriginal";   
        }
        
        
        
        //-- ASIDE (image artiste)
        echo "<div class='rotation'>"; // rotation de l'image de l artiste
            echo "<aside class='$feuilleStyleImage bordureAside$this->_theme'>"; // selection de l'image liée à l'artiste ainsi que sa bordure

            echo "</aside>";
        echo "</div>";
    }

    
    //======= 2. TITRE =======
    public function titre(){
        
        $artiste = $this->_tabFichesArtistes[0]->getNom();

        //-- TITRE ARTISTE
        echo "<div class='titreFenetreLiensMusiqes'>";
            echo "<div class='ajustementPlaceTitre'>";
                echo "<h1 class='titre$this->_theme'>$artiste</h1>";
            echo "</div>";
        echo "</div>";
    }
        
        
    //======= 3. FENETRE LIENS MUSIQUES OU CHOIX PLAYER =======
    public function fenetreLiensMusiqueOuChoixPlayer(){
       
        $this->fenetreLiensMusique();
        $this->choixPlayer();
       
    }
    // Sous fenetres
    public function fenetreLiensMusique(){
        $displayMusiques = (!strcmp($this->_afficheMusiquesOuChoixPlayer, "musiques")) ? "block" : "none";

        //-- FENETRE LIENS MUSIQUES
        echo "<div class='fenetreLiensMusiques bordureEtOmbreFenetreLiens$this->_theme $this->_fond2' style='display:$displayMusiques;'>"; // fond de la 2eme fenetre
        echo "<p class='policeLiensMusiques$this->_theme' style='cursor: default;'>&nbsp;&nbsp;&nbsp;Liens : </p>";

        $isVisible = "visible";// On affiche seulement la premiere fenetre de liens au départ
        $hauteurFenetre = "145px";
        for($curseur = 0; $curseur < count($this->_tabFichesArtistes); $curseur++) { // On parcourt les artistes et on cache leur fenetre de musiques
            $artisteSansEspace = $this->_tabFichesArtistes[$curseur]->getNomSansEspace();                            
            if($curseur > 0 ) {
                $isVisible = "nonVisible";
                $hauteurFenetre = "0px";
                echo "<div class='nonVisible $artisteSansEspace' style='height:0px;'>"; //si on supprime l'espace a la fin, ça ne marche plus ....??? // Bloc vers lequel on pointe pour trouver les bloc de liens d'un artiste
            }else {
                echo "<div class='nonVisible $artisteSansEspace' style='height:145px;'>"; //si on supprime l'espace a la fin, ça ne marche plus ....??? // Bloc vers lequel on pointe pour trouver les bloc de liens d'un artiste
            }
            //-- FENETRE CONTENANT LES 2 BLOCS LIENS DE CHAQUE ARTISTE
            echo "<p class='blocLiens blocLiens1 $isVisible'>";$this->_tabFichesArtistes[$curseur]->afficheLiensColonneGauche();echo "</p>";
            echo "<p class='blocLiens blocLiens2 $isVisible'>";$this->_tabFichesArtistes[$curseur]->afficheLiensColonneDroite();echo "</p>";
            echo "</div>";
        }
        echo "</div>";
    }
    public function choixPlayer(){
        $displayChoixPlayer = (!strcmp($this->_afficheMusiquesOuChoixPlayer, "choixPlayer")) ? "block" : "none";

        //-- FENETRE CHOIX PLAYER
        echo "<div class='fenetreLiensMusiques bordureEtOmbreFenetreLiens$this->_theme $this->_fond2' style='display:$displayChoixPlayer;'>"; // fond de la 2eme fenetre
            // Bouton Retour
            echo "<p id='retourFenetreLiensMusiques' class='policeLiensMusiques$this->_theme'>";
                echo"<span class='boutonRetourFenetreLiensMusiques couleurBordure$this->_theme'>Retour</span>";  
            echo "</p>";
        
            // Choix Player
            echo "<div class='fenetreChoixPlayer' style='height:145px;'>"; 

                // Nom de la musique
                echo "<div class='nomMusiqueChoixPlayer policeLiensMusiques$this->_theme'>nom musique</div>";     
                // Choix Liens
                echo "<div class='choixPlayer policeLiensMusiques$this->_theme'>";
                    // Bouton Youtube
                    echo "<div class='choixPlayer_Youtube choixPlayer_case'><a class='policeLiensMusiques$this->_theme couleurLienPlayer$this->_theme' href ='lien' target='_blank'>Lien Youtube</a></br>" ;
                    echo "</div>";
                    // Bouton Player
                    echo "<div class='choixPlayer_monPlayer choixPlayer_case'><span class='couleurLienPlayer$this->_theme lienPlayer'>Lien Player</span><a href ='lien' style='display: none;'></a></div>";
                    // Bouton Liste Lecture
                    echo "<div class='choixPlayer_monPlayer choixPlayer_case' style='margin-left:25%;'><span class='couleurLienPlayer$this->_theme lienPlayer'>Liste De Lecture</span><a href ='lien' style='display: none;'></a></div>";
                echo"</div>";  

            echo "</div>";
        echo "</div>";
    }
  
    
    //======= 4. BLOC BAS ARTICLE =======
    public function blocBasArticle(){

        $artiste = $this->_tabFichesArtistes[0]->getNom();
        
        echo "<div class='blocBasArticle'>";
            echo "<div class='fenetreAffichee'>";                

                if($this->_sessionActive == 1){
                    echo"<div class='basArticle_fenetre1 titre$this->_theme redefCouleurTitre$this->_theme' >Ajouter une Chanson</div>";
                    echo"<div class='basArticle_fenetre2 titre$this->_theme redefCouleurTitre$this->_theme' >Supprimer une chanson</div>";
                }          

            echo "</div>";
            echo "<div class='fenetreCachee'>";
                echo"<div class='basArticle_fenetreAjoutMusique titre$this->_theme redefCouleurTitre$this->_theme'>";                       
                    echo "<form action='blocDroit/ajoutMusique.php' method='post'>";     
                        echo "Titre &nbsp;<input type='text' name='musiqueAjoute' class='ajoutRapide_musique'/> &nbsp; &nbsp; &nbsp;";
                        echo "Lien &nbsp;<input type='text' name='lienAjoute' class='ajoutRapide_lien'/> &nbsp; &nbsp; &nbsp;";
                        // On met le nom du premier artiste = fenetre de départ
                        echo "<input type='hidden' name='artisteAjoute' value='$artiste' class='ajoutRapide_artiste'/>";

                        echo "<input type='submit' value='GO!' />";
                    echo "</form>";
                echo "</div>";

                echo"<div class='basArticle_fenetreRetour titre$this->_theme redefCouleurTitre$this->_theme'>";                            
                    echo "Retour"; 
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    
    
    
    
    
    
    //======= CREATION DES FICHES ARTISTES =======
  


    public function getBddTableau($tri){

        if(!empty($this->_tabStylesSelect)){
            // On doit preparer la requete en fonction du nombre de styles choisis
            $requete = 'SELECT artiste FROM bibliotheque '. str_repeat('WHERE style = ? ',!empty($this->_tabStylesSelect))  . " " .str_repeat('OR style = ?',count($this->_tabStylesSelect) - 1) . " " . str_repeat('ORDER BY artiste', $tri);
            $reponse = $this->_bdd->prepare($requete);
            $reponse->execute($this->_tabStylesSelect);
        }else {
            // Si aucun style n'a été choisi, on n'affiche pas les musiques de film (sinon on se retrouve avec les noms des films dans les noms d'artistes..)
            $requete = 'SELECT artiste FROM bibliotheque WHERE style <> ?'. " " . str_repeat('ORDER BY artiste', $tri);
            $reponse = $this->_bdd->prepare($requete);
            $reponse->execute(array('Film'));
        }



        // On recupere tous les artistes presents dans la BD dans un tableau
        $tableauArtiste = array();
        while($donnees = $reponse->fetch()) {
            if(!in_array($donnees['artiste'] , $tableauArtiste)){
                $tableauArtiste[] = $donnees['artiste'];
            }
        }
        $reponse->closeCursor();

        return $tableauArtiste;
    }

    public function initTableauxArtistes(){
        $this->_tableauArtisteTrie = $this->getBddTableau(1);
        $this->_tableauArtisteNonTrie = $this->getBddTableau(0);
    }

    public function initFichesArtistes(){

        // On récupèrer toutes les infos des artistes avec une boucle utilisant le 'tableauArtisteNonTrie' pour interroger la BD
        foreach($this->_tableauArtisteNonTrie as $caseArtiste) {
            $reponse = $this->_bdd->prepare('SELECT titre,lien,style FROM bibliotheque WHERE artiste = ? ORDER BY nbr_vues DESC');
            $reponse->execute(array($caseArtiste));

            $tabNomsMusiques = array();
            $tabLiensMusiques = array();

            while($donnees = $reponse->fetch()) {
                utf8_encode($donnees['titre']);
                if(!in_array($donnees['titre'] , $tabNomsMusiques)){
                    $tabNomsMusiques[] = $donnees['titre'];
                    $tabLiensMusiques[] = $donnees['lien'];
                    $style = $donnees['style'];  // Pas tres intelligent... va se repeter en boucle
                }
            }

            //Construction du tableau de fiches des artistes
            $this->_tabFichesArtistes[] = new FicheArtiste($caseArtiste,$tabNomsMusiques,$tabLiensMusiques,$style,$this->_theme);
        }
    }
    
    
    
    

}
?>
