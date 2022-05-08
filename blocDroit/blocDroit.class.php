<?php
// Classe créant le blocDroit
// Lié avec la feuille styleBlocDroit.css

class BlocDroit
{
    /* ATTRIBUTS */
    
    private $_bdd;
    private $_stylesChoisisFeuilleActuelle;
    private $_designationStyleChoisiFormulaire;
    private $_theme;
    private $_sessionActive; // 1 || 0
    private $_boitesFond1; //fondOriginal || degradeJauneRouge...
    private $_boitesCouleurTitre1; //boites_couleurTitreTHEME
    private $_boitesCouleurPolice1; //boites_couleurPoliceTHEME
    private $_couleurSeparateur; //boites_separateurBleue || boites_separateurRouge...
    private $_miniChatCouleurPseudo; //miniChat_couleurPseudoTHEME
    
    // Attributs créés grace aux précédents
    private $_blocDroit_boite1;
    private $_blocDroit_titre1;
    private $_cacheBloc;


    
    
    
    
    /* METHODES */
    
    // Construction de attributs de l'objet
    public function __construct($bdd, $stylesChoisisFeuilleActuelle, $designationStyleChoisiFormulaire, $theme, $sessionActive, $boitesFond1, $boitesCouleurTitre1, $boitesCouleurPolice1, $couleurSeparateur, $miniChatCouleurPseudo) {
        // Attributs récupérés via parametrePage
        $this->_bdd = $bdd;
        $this->_stylesChoisisFeuilleActuelle = $stylesChoisisFeuilleActuelle;
        $this->_designationStyleChoisiFormulaire = $designationStyleChoisiFormulaire;
        $this->_theme = $theme;
        $this->_sessionActive = $sessionActive;
        $this->_boitesFond1 = $boitesFond1;
        $this->_boitesCouleurTitre1 = $boitesCouleurTitre1;
        $this->_boitesCouleurPolice1 = $boitesCouleurPolice1;
        $this->_couleurSeparateur = $couleurSeparateur;
        $this->_miniChatCouleurPseudo = $miniChatCouleurPseudo;
    
        // Attributs créés grace aux précédents
        $this->_blocDroit_boite1 = "blocDroit_boiteSelector blocDroitFenetre $this->_boitesFond1";
        $this->_blocDroit_titre1 = "general_titreFenetreBlocDroit $this->_boitesCouleurTitre1 $this->_couleurSeparateur texteNonSelectionnable";
        $this->_cacheBloc = "height: 0px; visibility: hidden;";
    }
    
    // Definition des fonction créant les fenetres du blocDroit
    public function blocDroit_Fenetre_ouverture($titre){
        echo "<div class='$this->_blocDroit_boite1'>";
            echo "<div class='$this->_blocDroit_titre1'>$titre</div>";
            echo "<div style='$this->_cacheBloc'>"; // Bloc servant a afficher/cacher la suite    
    }
    public function blocDroit_Fenetre_fermeture(){
            echo "</div>";
        echo "</div>";
    }

    //====== FONCTION D'ASSEMBLAGE
    public function creationFenetre(){
        // On défini tt d'abord le contenant du bloc droit
        echo "<div class='blocDroit'>";


        // Bloc 1: AJOUT DE MUSIQUE
        $this->blocDroit_Fenetre_ouverture("Ajouter Une Musique");
        $this->FormulaireAjoutMusiqueBlocDroit();
        $this->blocDroit_Fenetre_fermeture();


        // bloc 2: MINI CHAT
        $this->blocDroit_Fenetre_ouverture("Mini Chat");
        $this->testNouveauMsgMiniChat();
        $this->MiniChat();  
        $this->blocDroit_Fenetre_fermeture();


        // bloc 3: LISTES DES MUSIQUES LES PLUS ÉCOUTÉES
        $this->blocDroit_Fenetre_ouverture("Musiques Les Plus Ecoutées");
        $this->affichageMusiqueLesPlusEcoutees();
        $this->blocDroit_Fenetre_fermeture();


        // bloc 4: LISTES DES DERNIERES MUSIQUES ÉCOUTÉES
        $this->blocDroit_Fenetre_ouverture("Dernières Ecoutes");
        $this->affichageDernieresEcoutees();
        $this->blocDroit_Fenetre_fermeture();




        //                // bloc 5: VIDEO
        //                echo "<div class=\"$blocDroit_boite1\">";
        //                    echo "<div class=\"general_titreFenetreBlocDroit blocDroitTitre2 $boitesCouleurTitre1 $couleurSeparateur texteNonSelectionnable\">Vidéos</div>";
        //                    echo "<div class=\"general_blocDroitSection blocDroitSection3 $boitesCouleurPolice1 \">";
        //                        $parametresPage->choixAleatoireVideo();
        //                    echo "</div>";
        //                echo "</div>";

        echo "</div>";


    }  
    
    
    
    
    
    //======= 1. AJOUT MUSIQUES BLOC DROIT =======
    public function FormulaireAjoutMusiqueBlocDroit(){
        echo "<div class='general_blocDroitSection blocDroitSection1 $this->_boitesCouleurPolice1'>";
        echo "<form action='blocDroit/ajoutMusique.php' method='post'>";
        echo "<div class='blocDescriptionInput'>Artiste</div> <input type='text' name='artisteAjoute' class='inputAjoutMusique'/><br />";
        echo "<div class='blocDescriptionInput'>Musique</div> <input type='text' name='musiqueAjoute' class='inputAjoutMusique'/><br />";
        echo "<div class='blocDescriptionInput'>Lien</div> <input type='text' name='lienAjoute' class='inputAjoutMusique'/><br />";
        echo "<div class='blocDescriptionInput'>Style</div> <input type='text' name='styleAjoute' class='inputAjoutMusique'/><br />";


        // Le transfert du style ne fonctionne pas a cause de la redirection...
        for($i = 0; $i < count($this->_designationStyleChoisiFormulaire); $i++){
            echo "<input type='hidden' name='$this->_designationStyleChoisiFormulaire[$i]' value='$this->_stylesChoisisFeuilleActuelle[$i]'/>";
        }

        if($this->_sessionActive == 1){
            echo "<input type='submit' value='GO!' />";
        }
        echo "</form>";
        echo "</div>";
    }
    
    //======= 2. MINI CHAT =======
    public function testNouveauMsgMiniChat(){
        if(isset($_POST['pseudo']) && isset($_POST['message'])) {
            $inputPseudo  = htmlspecialchars($_POST['pseudo']);
            $inputMessage = htmlspecialchars($_POST['message']);

            //On vérifie que le pseudo et le message ne sont pas vides
            if(strcmp($inputPseudo, "") && strcmp($inputMessage, "") && strcmp($inputMessage, "Votre message ici")) {  
                $this->UpdateDonneesMiniChat($inputPseudo, $inputMessage);
            }
        }
    }
    public function UpdateDonneesMiniChat($pseudo,$message){

        $req = $this->_bdd->prepare('INSERT INTO miniChat(pseudo, message) VALUES(:pseudo, :message)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'message' => $message

        ));

    }
    public function MiniChat(){
        echo "<div class='general_blocDroitSection blocDroitSection2 $this->_boitesCouleurPolice1 $this->_couleurSeparateur'>";

        $pseudo = "";
        $message = "";

        $reponse = $this->_bdd->query('SELECT pseudo,message FROM miniChat ORDER BY ID DESC');	
        while ($donnees = $reponse->fetch()) {
            $pseudo = $donnees['pseudo'];
            $message = $donnees['message'];

            echo "<span class='pseudoMiniChat $this->_miniChatCouleurPseudo'>@$pseudo:</span> <span class='$this->_boitesCouleurPolice1'>$message</span><br />";
        } 
        $reponse->closeCursor();

        echo "</div >";

        $this->formulaireMiniChat();

    }
    public function formulaireMiniChat(){
        echo "<div class='blocDroitInputMiniChat $this->_boitesCouleurPolice1 '>";

        echo "<form action='html07.php' method='post'>";
        echo "Pseudo <input type='text' name='pseudo' class='pseudoMiniChat'/>";
        echo "<textarea name='message' rows='3' cols='20'/>Votre message ici</textarea>";
        echo "<input type='submit' value='GO!' />";
        echo "</form>";

        echo "</div>";
    }    
    
    //======= 3. MUSIQUES LES PLUS ECOUTEES =======
    public function affichageMusiqueLesPlusEcoutees(){
        echo "<div class=\"general_blocDroitSection blocDroitSection2 blocDroitSection4 $this->_boitesCouleurPolice1 \">";

        $reponse = $this->_bdd->query('SELECT titre,lien,nbr_vues,artiste FROM bibliotheque ORDER BY nbr_vues DESC LIMIT 0,15');

        $i = 1;
        while ($donnees = $reponse->fetch()) {
            $artiste = $donnees['artiste'];
            $lien = $donnees['lien'];
            $titre = $donnees['titre'];
            $nbr_vues = $donnees['nbr_vues'];

            echo "<a class=" . $this->_boitesCouleurPolice1 . " href =\"section/compteurClic.php?lien=" . $lien ."\" target=\"_blank\"><span class=\"translationMusique\">($nbr_vues) $artiste - $titre</span></a></br>" ;
            $i++;
        } 
        $reponse->closeCursor();

        echo "</div>";

    }  
    
    //======= 4. DERNIERES MUSIQUES ECOUTEES =======
    public function affichageDernieresEcoutees(){
        echo "<div class=\"general_blocDroitSection blocDroitSection2 blocDroitSection4 $this->_boitesCouleurPolice1 \">";

        $reponse = $this->_bdd->query("SELECT titre,lien,date_derniere_lecture,artiste FROM bibliotheque ORDER BY date_derniere_lecture DESC LIMIT 0,15");

        $i = 1;
        while ($donnees = $reponse->fetch()) {
            $artiste = $donnees['artiste'];
            $lien = $donnees['lien'];
            $titre = $donnees['titre'];
            $date_derniere_lecture = $donnees['date_derniere_lecture'];
            $date_derniere_lecture = str_replace("-","/",$date_derniere_lecture,$date_derniere_lecture); //transformation des "-" en "/" 
            $date_derniere_lecture = preg_replace("#:[0-9][0-9]$#","",$date_derniere_lecture);

            echo "<a class=" . $this->_boitesCouleurPolice1 . " href =\"section/compteurClic.php?lien=" . $lien ."\" target=\"_blank\"><span class=\"translationMusique\"> $artiste - $titre ($date_derniere_lecture)</span></a></br>" ;
            $i++;
        } 
        $reponse->closeCursor();

        echo "</div>";

    }
    

  
}
?>
