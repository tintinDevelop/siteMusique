<?php


class ParamPage
{
    private $_connexion = "local";
//    private $_connexion ="serveur";
    
    
    // Attributs Liés A La Creation De La Page
    private $_theme;
    private $_tabStylesSelect;
    private $_tabStyleNomChampFormulaire;
    private $_tableauArtisteTrie;
    private $_tableauArtisteNonTrie;
    private $_artistes; // Objet de la class FicheArtiste

    
    // Attributs Généraux
    private $_couleurBordureGeneral;
    private $_couleurTitrePrincipal;
    
    // Attribut Fenetre News et Choix Styles
    private $_couleurTitreFenetreNewsEtChoixStyle;
    
    // Attribut Section
    private $_boitesFond1;
    private $_boitesFond2;
    private $_boitesCouleurTitre1;
    private $_boitesCouleurPolice1;

    
    // Attribut Bloc Droit
    private $_couleurSeparateur;
    private $_couleurPseudoMiniChat;
    
    // Attribut Footer
    private $_Footer_titre_couleur;
    private $_Footer_policeCellule_couleur;
    
    
    
    
   
    
   // FONCTION retournant la bonne config pour l'acces serveur local ou distant
    public function getTypeConnexion(){return $this->_connexion;}
    
    
    
    //==============================FONCTION DEFINITION STYLE=========================//
    // "Rock", "Rap", "Reggae" ...
    function recuperationStyles($nombreStyles, $tab){
        $nomDuStyle = "";

        for($i = 2; $i <= $nombreStyles; $i++) 
        {
            $nomDuStyle = "style$i";

            if(isset($_POST["$nomDuStyle"])) { 
                $tab[] = htmlspecialchars($_POST["$nomDuStyle"]);
            }
        }

        // Si on choisi le style ALL, on met tous les artistes donc on vide le tableau
        if(isset($_POST['style1'])) 
        { 
            $tab = array();
        }

        return $tab;
    }
    // "style1", "style2", "style3" ...
    function recuperationDesginationsFormulaire($nombreStyles, $tabStyleNomChampFormulaire){
        $nomDuStyle = "";

        for($i = 2; $i <= $nombreStyles; $i++) 
        {
            $nomDuStyle = "style$i";

            if(isset($_POST["$nomDuStyle"])) { 
                $tabStyleNomChampFormulaire[] = "$nomDuStyle";
            }
        }

        // Si on choisi le style ALL, on met tous les artistes donc on vide le tableau
        if(isset($_POST['style1'])) 
        { 
            $tabStyleNomChampFormulaire = array();
        }

        return $tabStyleNomChampFormulaire;
    }
    // Charge le tableau des styles et met a jour le theme
    public function setTabStylesSelect($tableauStyles, $tabStyleNomChampFormulaire){
        $this->_tabStylesSelect = $tableauStyles;
        $this->_tabStyleNomChampFormulaire = $tabStyleNomChampFormulaire;
        
        if(count($tableauStyles)) {
            if(!strcmp($tableauStyles[0], "Rock") || !strcmp($tableauStyles[0], "Rap") || !strcmp($tableauStyles[0], "Reggae") || !strcmp($tableauStyles[0], "Pop")) {
                $this->_theme = $tableauStyles[0];
            }else {
                $this->_theme = 'All';
            }
        } else {
            $this->_theme = 'All';
        }
    }
    
    
    
    // Definission des couleurs des éléments en fonction des styles
    public function initParamTheme(){
        // RECUPERATION DES FORMULAIRES DE STYLES ENVOYES A LA PAGE 
        $tab = array();
        $tabStyleNomChampFormulaire = array();
        
        // On récupère maintenant les tableaux chargés avec les noms des styles
        $tab = $this->recuperationStyles(10, $tab);
        $tabStyleNomChampFormulaire = $this->recuperationDesginationsFormulaire(10, $tabStyleNomChampFormulaire);
        
        $this->setTabStylesSelect($tab, $tabStyleNomChampFormulaire);
        $this->initTableauxArtistes();
        $this->initFichesArtistes();
        
        
        
        
        
        if(!strcmp($this->_theme, 'All')){
            
            // General
            $this->_couleurBordureGeneral = "bordureGeneralAll";
            $this->_couleurTitrePrincipal = "couleurTitrePrincipalAll";
            
            // Fond fenetres: ancres, artistes et bloc droit
            $this->_boitesFond1 = "fondOriginal";
            
            // Titre fenetres: ancres et bloc droit
            $this->_boitesCouleurTitre1 = "boites_couleurTitreAll";
            $this->_boitesCouleurPolice1 = "boites_couleurPoliceAll";
            
            // Fond 2eme fenetre artiste (liens)
            $this->_boitesFond2 = "";
            
            // BlocDroit
            $this->_couleurSeparateur = "boites_separateurBleue";
            $this->_couleurPseudoMiniChat = "miniChat_couleurPseudoAll";
            
            // Fenetres news et choix styles
            $this->_couleurTitreFenetreNewsEtChoixStyle = "fntrNewsEtChoixStyle_couleurTitreAll";
            
            // Footer
            $this->_Footer_titre_couleur = "footer_couleurTitreAll";
            $this->_Footer_policeCellule_couleur = "footer_couleurPoliceCelluleAll";
            
            
       }else if(!strcmp($this->_theme, 'Rock')){
            
            // General
            $this->_couleurBordureGeneral = "bordureGeneralRock";
            $this->_couleurTitrePrincipal = "couleurTitrePrincipalRock";
            
            // Fond fenetres: ancres, artistes et bloc droit
            $this->_boitesFond1 = "degradeJauneRouge";
            
            // Titre fenetres: ancres et bloc droit
            $this->_boitesCouleurTitre1 = "boites_couleurTitreRock";
            $this->_boitesCouleurPolice1 = "boites_couleurPoliceRock";
            
            // Fond 2eme fenetre artiste (liens)
            $this->_boitesFond2 = "degradeBleu";
            
            // BlocDroit
            $this->_couleurSeparateur = "boites_separateurBleue";
            $this->_couleurPseudoMiniChat = "miniChat_couleurPseudoRock";
            
            // Fenetres news et choix styles
            $this->_couleurTitreFenetreNewsEtChoixStyle = "fntrNewsEtChoixStyle_couleurTitreRock";
            
            // Footer
            $this->_Footer_titre_couleur = "footer_couleurTitreRock";
            $this->_Footer_policeCellule_couleur = "footer_couleurPoliceCelluleRock";

            
        }else if(!strcmp($this->_theme, 'Rap')){
            
            // General
            $this->_couleurBordureGeneral = "bordureGeneralRap";
            $this->_couleurTitrePrincipal = "couleurTitrePrincipalRap";
            
            // Fond fenetres: ancres, artistes et bloc droit
            $this->_boitesFond1 = "degradeGris2";
            
            // Titre fenetres: ancres et bloc droit
            $this->_boitesCouleurTitre1 = "boites_couleurTitreRap";
            $this->_boitesCouleurPolice1 = "boites_couleurPoliceRap";
            
            // Fond 2eme fenetre artiste (liens)
            $this->_boitesFond2 = "degradeBleu";
            
            // BlocDroit
            $this->_couleurSeparateur = "boites_separateurBleue";
            $this->_couleurPseudoMiniChat = "miniChat_couleurPseudoRap";
            
            // Fenetres news et choix styles
            $this->_couleurTitreFenetreNewsEtChoixStyle = "fntrNewsEtChoixStyle_couleurTitreRap";
           
            // Footer
            $this->_Footer_titre_couleur = "footer_couleurTitreRap";
            $this->_Footer_policeCellule_couleur = "footer_couleurPoliceCelluleRap";

            
        }else if(!strcmp($this->_theme, 'Reggae')){
            
            // General
            $this->_couleurBordureGeneral = "bordureGeneralReggae";
            $this->_couleurTitrePrincipal = "couleurTitrePrincipalReggae";
            
            // Fond fenetres: ancres, artistes et bloc droit
            $this->_boitesFond1 = "degradeVertFonce";
            
            // Titre fenetres: ancres et bloc droit
            $this->_boitesCouleurTitre1 = "boites_couleurTitreReggae";
            $this->_boitesCouleurPolice1 = "boites_couleurPoliceReggae";
            
            // Fond 2eme fenetre artiste (liens)
            $this->_boitesFond2 = "degradeJauneRouge";
            
            // BlocDroit
            $this->_couleurSeparateur = "boites_separateurRouge";
            $this->_couleurPseudoMiniChat = "miniChat_couleurPseudoReggae";
            
            // Fenetres news et choix styles
            $this->_couleurTitreFenetreNewsEtChoixStyle = "fntrNewsEtChoixStyle_couleurTitreReggae";
            
            // Footer
            $this->_Footer_titre_couleur = "footer_couleurTitreReggae";
            $this->_Footer_policeCellule_couleur = "footer_couleurPoliceCelluleReggae";


        }else if(!strcmp($this->_theme, 'Pop')){
            
            // General
            $this->_couleurBordureGeneral = "bordureGeneralPop";
            $this->_couleurTitrePrincipal = "couleurTitrePrincipalPop";
            
            // Fond fenetres: ancres, artistes et bloc droit
            $this->_boitesFond1 = "degradeOrange2";
//            $this->_boitesFond1 = "degradeRougeJaune";
            
            // Titre fenetres: ancres et bloc droit
            $this->_boitesCouleurTitre1 = "boites_couleurTitrePop";
            $this->_boitesCouleurPolice1 = "boites_couleurPolicePop";
            
            // Fond 2eme fenetre artiste (liens)
//            $this->_boitesFond2 = "degradeBleu";
            $this->_boitesFond2 = "degradeBlanc";
            
            // BlocDroit
            $this->_couleurSeparateur = "boites_separateurGris";
            $this->_couleurPseudoMiniChat = "miniChat_couleurPseudoPop";
            
            // Fenetres news et choix styles
            $this->_couleurTitreFenetreNewsEtChoixStyle = "fntrNewsEtChoixStyle_couleurTitrePop";
            
            // Footer
            $this->_Footer_titre_couleur = "footer_couleurTitrePop";
            $this->_Footer_policeCellule_couleur = "footer_couleurPoliceCellulePop";

        }
    }
    
        
    public function getTabStylesSelect(){return $this->_tabStylesSelect;}
    public function getTabStylesNomChampFormulaire(){return $this->_tabStyleNomChampFormulaire;}  // Return style1, style2...
    public function getTheme(){return $this->_theme;}
    //==============================fin definition style===============================//

    
    
    
    //====================FONCTIONS DEFINTIONS GENERALES DU STYLE======================//
    public function getCouleurBordureGeneral(){return $this->_couleurBordureGeneral;}
    public function getCouleurTitrePrincipal(){return $this->_couleurTitrePrincipal;}
    //========================fin definition general du style==========================//

    
    
    
    
    //===================FONCTION FENETRE NEWS ET CHOIX STYLE===========================//
    public function getCouleurTitreFenetreNewsEtChoixStyle(){return $this->_couleurTitreFenetreNewsEtChoixStyle;}
    //=====================fin fenetre news et choix style==============================//
        
        
        
        

    //==============================FONCTION SECTION====================================//
    public function get_boitesFond1(){return $this->_boitesFond1;}
    public function get_boitesFond2(){return $this->_boitesFond2;}
    public function get_boitesCouleurTitre1(){return $this->_boitesCouleurTitre1;}
    public function get_boitesCouleurPolice1(){return $this->_boitesCouleurPolice1;}
    //==============================fin section=========================================//

    
    
    
    
    
    //==============================FONCTION BLOC DROIT=================================//
    public function getCouleurSeparateur(){return $this->_couleurSeparateur;}
    public function getCouleurPseudoMiniChat(){return $this->_couleurPseudoMiniChat;}
    //==============================fin bloc droit======================================//


    
    
    
    
    //=============================FONCTION FOOTER======================================//
    public function getTitreFooter_couleur(){return $this->_Footer_titre_couleur;}
    public function getPoliceCellule_couleur(){return $this->_Footer_policeCellule_couleur;}
    //================================fin footer========================================//

    
    
    
    
    //==============================FONCTION BDD========================================//
    public function getTableauArtisteTrie() {return $this->_tableauArtisteTrie;}
    public function getTableauArtisteNonTrie() {return $this->_tableauArtisteNonTrie;}
    public function getFichesArtistes() {return $this->_artistes;}
    

    
       
    public function BddConnect(){
        try {
            if(!strcmp($this->getTypeConnexion(),"local")){
                $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 			
            } else {
                $bdd = new PDO('mysql:host=db567390711.db.1and1.com;dbname=db567390711', 'dbo567390711', '09091990tintin',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
            }
                // $bdd->exec("SET CHARACTER SET utf8");			
        }catch(Exception $e) {
            die('Erreur : '.$e->getMessage()); 
        }

        return $bdd;
    }



    /*
	Fonction qui renvoie la liste des artistes en fonction des sytles sélectionnés 
    *tri => flag pour choisir de trier ou non par ordre alphabetique
    */  
    public function getBddTableau($tri){
        $bdd = $this->BddConnect();

        if(!empty($this->_tabStylesSelect)){
            // On doit preparer la requete en fonction du nombre de styles choisis
            $requete = 'SELECT artiste FROM bibliotheque '. str_repeat('WHERE style = ? ',!empty($this->_tabStylesSelect))  . " " .str_repeat('OR style = ?',count($this->_tabStylesSelect) - 1) . " " . str_repeat('ORDER BY artiste', $tri);
//            $requete = 'SELECT artiste FROM bibliotheque WHERE style = Chanson Française';
//            $reponse = $bdd->query('SELECT artiste FROM bibliotheque WHERE style = Chanson FranÃ§aise');
            $reponse = $bdd->prepare($requete);
            $reponse->execute($this->_tabStylesSelect);
        }else {
            // Si aucun style n'a été choisi, on n'affiche pas les musiques de film (sinon on se retrouve avec les noms des films dans les noms d'artistes..)
            $requete = 'SELECT artiste FROM bibliotheque WHERE style <> ?'. " " . str_repeat('ORDER BY artiste', $tri);
            $reponse = $bdd->prepare($requete);
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
        $bdd = $this->BddConnect();
        
        // On récupèrer toutes les infos des artistes avec une boucle utilisant le 'tableauArtisteNonTrie' pour interroger la BD
        foreach($this->_tableauArtisteNonTrie as $caseArtiste) {
            $reponse = $bdd->prepare('SELECT titre,lien,style FROM bibliotheque WHERE artiste = ? ORDER BY nbr_vues DESC');
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
            
           //Construction de la fiche de l'artiste
            $this->_artistes[] = new FicheArtiste($caseArtiste,$tabNomsMusiques,$tabLiensMusiques,$style,$this->_theme);
        }
    }
    
    public function choixAleatoireVideo(){
        $modulo = count($this->_tableauArtisteNonTrie);
        $choix1 = time()%$modulo;
        $choix2 = (time()%210)%$modulo;
        $choix3 = (time()%536)%$modulo;
//        echo $this->_tableauArtisteNonTrie[$choix1];
//        echo $this->_tableauArtisteNonTrie[$choix2];
//        echo $this->_tableauArtisteNonTrie[$choix3];
        
        $tab1 = $this->_artistes[$choix1]->getTableauLiensMusiques();
        $tab2 = $this->_artistes[$choix2]->getTableauLiensMusiques();
        $tab3 = $this->_artistes[$choix3]->getTableauLiensMusiques();
        
      
        $choix1 = time()%44%(count($tab1)) - 1;
        $lien1 = $tab1[$choix1];
        
        $choix2 = time()%98%(count($tab2)) - 1;
        $lien2 = $tab2[$choix2];
        
        $choix3 = time()%344%(count($tab3)) - 1;
        $lien3 = $tab3[$choix3];
        
        
        $lien1 = preg_replace('#^h(.+)=#i', '//www.youtube.com/embed/', $lien1);
        $lien2 = preg_replace('#^h(.+)=#i', '//www.youtube.com/embed/', $lien2);
        $lien3 = preg_replace('#^h(.+)=#i', '//www.youtube.com/embed/', $lien3);
 
        try{
            echo "<iframe width=\"99.5%\" height=\"150\" src=\"$lien1\" frameborder=\"0\" allowfullscreen></iframe>";
        }catch(Exception $e) {
            die('Erreur : '.$e->getMessage()); 
        }
        
        try{
            echo "<iframe width=\"99.5%\" height=\"150\" src=\"$lien2\" frameborder=\"0\" allowfullscreen></iframe>";
        }catch(Exception $e) {
            die('Erreur : '.$e->getMessage()); 
        }
        
        try{
            echo "<iframe width=\"99.5%\" height=\"150\" src=\"$lien3\" frameborder=\"0\" allowfullscreen></iframe>";
        }catch(Exception $e) {
            die('Erreur : '.$e->getMessage()); 
        }
        
    }
    
    public function getBddTabStyles(){
        $bdd = $this->BddConnect();
        $reponse = $bdd->query('SELECT style FROM bibliotheque');    
        
        $tabStyles = array();
        
        while($donnees = $reponse->fetch()) {
            if(!in_array($donnees['style'] , $tabStyles)){
                $tabStyles[] = $donnees['style'];
            }
        }
        
     
        return $tabStyles;
    }

    
    //==============================fin fonction bdd=================================//

}
