<?php 
    /* Permet l'utilisation des $_SESSION */
    session_start();
?>


<?php
    /* Permet d'afficher les erreurs sous mac même quand on a pas trouvé la bonne conf d'apache (fichier php.ini dans /mamp/conf/) */
    ini_set('display_errors','on');
    error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html> 
	<head>
		<!--[if lt IE 9]>
		<script 
		src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
		<![endif]-->
		
		<!--[if lte IE 7]>
		<link rel="stylesheet" href="style_ie.css" /> 
		<![endif]-->
		<?php
		echo "<link rel='stylesheet'  href='styleFeuillePrincipale.css' />";
        echo "<link rel='stylesheet'  href='blocDroit/styleBlocDroit.css' />";
        echo "<link rel='stylesheet'  href='header/styleHeader.css' />";
        echo "<link rel='stylesheet'  href='banniere/styleBanniere.css' />";
        echo "<link rel='stylesheet'  href='nav/styleAncreArtiste.css' />";
        echo "<link rel='stylesheet'  href='degrade.css' />";
        echo "<link rel='stylesheet'  href='footer/styleFooter.css' />";
        echo "<link rel='stylesheet'  href='section/styleSectionArtiste.css' />";
        echo "<link rel='stylesheet'  href='player/stylePlayer.css' />";

        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Le Mur Du Son</title> 
	</head>
    
    

    
    
    
	<?php

    // PARAMETRES DE LA PAGE: FICHES ARTISTES && THEME
    include_once("ficheArtiste.class.php");
    include_once("paramPage.class.php");
    $parametresPage = new ParamPage();
//    $parametresPage->setTabStylesSelect($tab, $tabStyleNomChampFormulaire);
    $parametresPage->initParamTheme();
//    $parametresPage->initTableauxArtistes();
//    $parametresPage->initFichesArtistes();
    $theme = $parametresPage->getTheme();


    // CLASS SESSION
    include_once("session.class.php");
    $page_session = new Session();
    $page_session->creationSession();


    

// RECUPERATION DES ARGUMENTS
// Header
$bordureGeneralCouleur = $parametresPage->getCouleurBordureGeneral();
$couleurTitrePrincipal = $parametresPage->getCouleurTitrePrincipal();
$session_pseudo = $page_session->getPseudo();
// Banniere
$bdd = $parametresPage->BddConnect(); // Rock, Rap ...
$tab = $parametresPage->getBddTabStyles();
$couleurTitreFenetreNewsEtChoixStyle = $parametresPage->getCouleurTitreFenetreNewsEtChoixStyle();
// Bloc Gauche
$boitesFond1 = $parametresPage->get_boitesFond1();
$boitesCouleurTitre1 = $parametresPage->get_boitesCouleurTitre1();
$boitesCouleurPolice1 = $parametresPage->get_boitesCouleurPolice1();
$tableauArtisteTrie = $parametresPage->getTableauArtisteTrie();
// Section
$stylesChoisisFeuilleActuelle = $parametresPage->getTabStylesSelect(); // Rock, Rap ...
$designationStyleChoisiFormulaire = $parametresPage->getTabStylesNomChampFormulaire(); // Style2, Style3...
$sessionActive = $page_session->isSessionActive();
$boitesFond2 = $parametresPage->get_boitesFond2();
// Bloc Droit
$couleurSeparateur = $parametresPage->getCouleurSeparateur();
$miniChatCouleurPseudo = $parametresPage->getCouleurPseudoMiniChat();
// Footer
$footer_couleurTitre = $parametresPage->getTitreFooter_couleur();
$footer_couleurPoliceCellule = $parametresPage->getPoliceCellule_couleur();





// CLASS PLAYER
include_once("player/player.class.php");
$player = new Player($theme, $boitesFond1);
$player->creationFenetre();





// CORPS DE LA PAGE
echo "<body class =\"$theme\">";
// 1. The <iframe> (and video player) will replace this <div> tag. -->
    echo"<div id='player'></div>";


// HEADER
/*
    $bordureGeneralCouleur
    $couleurTitrePrincipal
    $session_pseudo
*/
include_once("header/header.class.php");
$header = new Header($theme, $bordureGeneralCouleur, $couleurTitrePrincipal, $session_pseudo);
$header->creationFenetre();


// BANNIERE
/*
    $bdd
    $theme
    $tab
    $bordureGeneralCouleur
    $couleurTitreFenetreNewsEtChoixStyle
*/
include_once("banniere/banniere.class.php");
$banniere = new Banniere($bdd, $theme, $tab, $bordureGeneralCouleur, $couleurTitreFenetreNewsEtChoixStyle);
$banniere->creationFenetre();


// BLOCGAUCHE: LIENS CHOIX ARTISTES
/*
    $boitesFond1
    $boitesCouleurTitre1
    $boitesCouleurPolice1
    $tableauArtisteTrie
*/
include_once("nav/blocGauche.class.php");
$blocGauche = new BlocGauche($boitesFond1, $boitesCouleurTitre1, $boitesCouleurPolice1, $tableauArtisteTrie);
$blocGauche->creationFenetre();


// SECTION ARTISTE
/*
    $stylesChoisisFeuilleActuelle
    $designationStyleChoisiFormulaire
    $sessionActive
    $boitesFond1
    $boitesFond2
*/
include_once("section/article.class.php");
$article = new Article($bdd, $theme, $stylesChoisisFeuilleActuelle, $designationStyleChoisiFormulaire, $sessionActive, $boitesFond1, $boitesFond2);
$article->creationFenetre();


// BLOC DROIT
/*
    $stylesChoisisFeuilleActuelle
    $designationStyleChoisiFormulaire
    $sessionActive
    $boitesFond1
    $boitesCouleurTitre1
    $boitesCouleurPolice1
    $couleurSeparateur
    $miniChatCouleurPseudo
*/
include_once("blocDroit/blocDroit.class.php");
$blocDroit = new BlocDroit($bdd, $stylesChoisisFeuilleActuelle, $designationStyleChoisiFormulaire, $theme, $sessionActive, $boitesFond1, $boitesCouleurTitre1, $boitesCouleurPolice1, $couleurSeparateur, $miniChatCouleurPseudo);
$blocDroit->creationFenetre();


// FOOTER
/*
    $theme
    $designationStyleChoisiFormulaire
    $bordureGeneralCouleur
    $footer_couleurTitre
    $footer_couleurPoliceCellule
*/
include_once("footer/footer.class.php");
$footer = new Footer($theme, $bordureGeneralCouleur, $footer_couleurTitre, $footer_couleurPoliceCellule);
$footer->creationFenetre();



    ?>
		
	</body> 
</html>



<!--  SCRIPTS  -->





<!-- HEADER : Affiche/masque les blocs: pseudo, mdp, connexion, inscription -->
<script> 

    function header_afficheOuCache(lienDepart) {
        lienDepart = lienDepart.target;
        //        var lienFenetre = lienDepart.previousElementSibling;
        var lienFenetre1 = lienDepart.previousElementSibling;
        var lienFenetre2 = lienDepart.previousElementSibling.previousElementSibling;
        if(lienFenetre1.style.height == "0px") {
            lienFenetre1.style.height = "100%";
            lienFenetre1.style.width = "70%";
            lienFenetre1.style.visibility = "visible";

            lienFenetre2.style.visibility = "hidden";
            lienFenetre2.style.height = "0px";
            lienFenetre2.style.width = "0px";
        } else {
            lienFenetre1.style.visibility = "hidden";
            lienFenetre1.style.height = "0px";
            lienFenetre1.style.width = "0px";

            lienFenetre2.style.height = "100%";
            lienFenetre2.style.width = "70%";
            lienFenetre2.style.visibility = "visible";
        }
    }
    function header_affectationAfficheOuCache(lienBoite) {
        lienBoite.addEventListener('click', function(e) {header_afficheOuCache(e);}, false);
    }

    // On vise le bloc "Profil"
    var header_lienCaseProfil = document.querySelector('.caseProfil'); 

    header_affectationAfficheOuCache(header_lienCaseProfil);

</script>

<!-- HEADER : Bouton affiche/masque le player -->
<script>
    function Player_affichage(clicCasePlayer) {

        // Affichage/masquage du player
        var lienFenetrePlayer = document.querySelector('.player_fenetre'); 


        if(lienFenetrePlayer.style.display == "block"){
            //Si le player est affiché

            if(lienFenetrePlayer.style.height == "0px"){

                var fenetrePlayer_height = sessionStorage.getItem("fenetrePlayer_height");

                lienFenetrePlayer.style.visibility = "visible";
                lienFenetrePlayer.style.height = fenetrePlayer_height;            
            }else{

                sessionStorage.setItem("fenetrePlayer_height",lienFenetrePlayer.style.height)

                lienFenetrePlayer.style.visibility = "hidden";
                lienFenetrePlayer.style.height = "0px";
            }
        }
        else{
            //Sinon on ne fait rien
        }


    }



    // Bouton de changement de musique du player + de son affichage
    var lienCasePlayer = document.querySelector('.bandeauOriginal_casePlayer'); 
    lienCasePlayer.addEventListener('click', function(e) {Player_affichage(e);}, false);


</script>



<!-- NAV : Recupere l'artiste selectionné et change l'artiste de la section -->
<script>  
    function affectationFenetreArtiste(clicAncreArtiste) {
        // On remet les couleurs des ancres non selectionnées
        var couleurLien;

        var recherche = clicAncreArtiste.target.parentNode.parentNode.parentNode.firstElementChild;
        while(recherche) {
            couleurLien = recherche.firstElementChild.firstElementChild.className.split(" ")[0];
            recherche.firstElementChild.firstElementChild.className = couleurLien;
            recherche = recherche.nextElementSibling; // On passe à l'artiste suivant
        }
        // On affecte la couleur à l'ancre sélectionnée: "couleurAncreRock" => "couleurAncreRock couleurAncreRockOnClick"
        clicAncreArtiste.target.className = couleurLien + " " + couleurLien + "OnClick";


        var nomArtiste = clicAncreArtiste.target.innerHTML;
        var nomArtisteSansEspace = nomArtiste.replace(/\s+/g,"");  // On supprime les espaces du nom de l'artiste                
        nomArtisteSansEspace = nomArtisteSansEspace.replace(".","");  // On supprime les point du nom de l'artiste                
        nomArtisteSansEspace = nomArtisteSansEspace.replace(".",""); 

        var lienDepart;
        // Modification de l'image de l'artiste
        lienDepart = document.querySelector('.positionArticle');
        var lienImage = lienDepart.firstChild.firstChild;
        var tabClassImage = (lienImage.className).split(" "); // Permet de garder la bordure de l'image
        lienImage.className = "img" + nomArtisteSansEspace + " " + tabClassImage[1] + " imgOriginal";

        // Modification du nom de l'artiste
        lienDepart = document.querySelector('.titreFenetreLiensMusiqes .ajustementPlaceTitre');
        var lienTitre = lienDepart.firstChild;
        lienTitre.innerHTML = nomArtiste;


        // Disparition des autres liens
        lienDepart = document.querySelector('.fenetreLiensMusiques');
        var lienBlocsACacher = lienDepart.firstChild.nextElementSibling;
        while(lienBlocsACacher) {
            lienBlocsACacher.style.height = "0px";
            lienBlocsACacher = lienBlocsACacher.firstChild;
            lienBlocsACacher.className = "blocLiens blocLiens1 nonVisible";
            lienBlocsACacher = lienBlocsACacher.nextElementSibling;
            lienBlocsACacher.className = "blocLiens blocLiens2 nonVisible";

            lienBlocsACacher = lienBlocsACacher.parentNode.nextElementSibling; // On passe à l'artiste suivant
        }


        // Affichage des liens de l'artiste
        lienDepart = document.querySelector("." + nomArtisteSansEspace);

        lienDepart.style.height = "145px";
        var lienBlocLien1 = lienDepart.firstChild;
        lienBlocLien1.className = "blocLiens blocLiens1 visible";
        var lienBlocLien2 = lienBlocLien1.nextElementSibling;
        lienBlocLien2.className = "blocLiens blocLiens2 visible";  

        // Affectation de la fenetre d'ajout rapide de musiques
        lienDepart = document.querySelector(".ajoutRapide_artiste");
        lienDepart.value = nomArtiste;
    }



    // Création de l'event permettant de récup tous les id des différentes ancres des artistes
    var lien1 = document.querySelector('ul'); 
    var liensEnfants = lien1.childNodes;


    // Affectation des event "click" aux liens vers les artistes
    for(var i = 0; i < liensEnfants.length; i++) {
        liensEnfants[i].firstChild.addEventListener('click', function(e) {affectationFenetreArtiste(e);}, false);
    }
</script>



<!-- SECTION : Affiche liens youtube ou fenetre player  -->
<script>  
    /* Affichage de la fenetre de selection de lecture */
    function affichageChoixPlayer(clicAncreArtiste) {
        
        
        // On fait d'abord disparaitre la fenetre avec tous les liens
        var lienVersFenetreLiensMusiques = document.querySelectorAll('.fenetreLiensMusiques');  
        lienVersFenetreLiensMusiques[0].style.display = "none";
        
        
        // On récupère le nom de la musique
        var nomMusique = clicAncreArtiste.target.innerHTML; 
        // On récupère le lien de la musique
        var lienMusique = clicAncreArtiste.target.parentNode.nextElementSibling.innerHTML; 
        // On ajoute le lien vers la page comptant le nombre de clics
        lienVersYoutube = "section/compteurClic.php?lien=" + lienMusique;

        // On affiche le nom de la musique dans la fenetre
        var caseArtisteChoixPlayer = document.querySelector('.nomMusiqueChoixPlayer');
        caseArtisteChoixPlayer.innerHTML = nomMusique;
        // On ajoute le lien youtube
        var caseLienYoutubeChoixPlayer = document.querySelector('.choixPlayer_Youtube');
        caseLienYoutubeChoixPlayer.firstElementChild.href = lienVersYoutube;
        caseLienYoutubeChoixPlayer = document.querySelectorAll('.choixPlayer_monPlayer');
        caseLienYoutubeChoixPlayer[0].firstElementChild.nextElementSibling.href = lienMusique;
        caseLienYoutubeChoixPlayer[1].firstElementChild.nextElementSibling.href = lienMusique;
        
        
        // On affiche la nouvelle fenetre de selection du player
        lienVersFenetreLiensMusiques[1].style.display = "block";
    }
    
    /* Retour du choix du player vers le liens de l artiste*/
    function RetourVersChoixMusiques(clicBoutonRetour) {
        
        
        var lienVersFenetreLiensMusiques = document.querySelectorAll('.fenetreLiensMusiques'); 
        lienVersFenetreLiensMusiques[1].style.display = "none";
        lienVersFenetreLiensMusiques[0].style.display = "block";
    }
    
    
    

    // Création de l'event permettant de récup tous les id des différentes ancres des artistes
    var lienVersLiensMusiques = document.querySelectorAll('#lienChoixPlayer'); 

    // Affectation des event "click" aux liens des musiques
    for(var i = 0; i < lienVersLiensMusiques.length; i++) {
        lienVersLiensMusiques[i].addEventListener('click', function(e) {affichageChoixPlayer(e);}, false);
    }

    // Bouton de retour vers les liens des musiques
    var lienRetourFenetreLiensMusiques = document.querySelector('#retourFenetreLiensMusiques'); 
    lienRetourFenetreLiensMusiques.addEventListener('click', function(e) {RetourVersChoixMusiques(e);}, false);

</script>

<!-- SECTION : Changer la musique du player -->
<script>
    function Player_changementMusique(clicLienPlayer) {
        // On récupère le lien youtube a injecter dans le player
        var lienYoutube = clicLienPlayer.target.nextElementSibling;
        lienYoutube = lienYoutube.href;
//        alert(lienYoutube);
        
        // Il y a 3 types de liens donc on doit trouver dans quel cas on se trouve: http, https, ou localhost...
        lienYoutube = lienYoutube.replace(/[a-z0-9\.:\/_]*www\.youtube\.com\/watch\?v=/,"http://www.youtube.com/embed/");

//      alert(lienYoutube);

        // On l'affecte au player
        var lienMusiquePlayer = document.querySelector('.player_fenetreVideo');
        lienMusiquePlayer = lienMusiquePlayer.firstElementChild;
        
        lienMusiquePlayer.src = lienYoutube;
//        alert(lienMusiquePlayer.src);
        
        
        
        // Affichage du player
        var lienFenetrePlayer = document.querySelector('.player_fenetre'); 
        lienFenetrePlayer.style.display = "block";
        
//        //Affichage de la musique si on a affiché la LL
//        lienFenetrePlayer = document.querySelector('.player_fenetreVideo'); 
//        lienFenetrePlayer.style.display = "block";
        if(lienFenetrePlayer.style.height == "0px"){

            var fenetrePlayer_height = sessionStorage.getItem("fenetrePlayer_height");

            lienFenetrePlayer.style.visibility = "visible";
            lienFenetrePlayer.style.height = fenetrePlayer_height;            
        }
        
    }
   

      
    // Bouton de changement de musique du player + de son affichage
    var lienChangementMusiquePlayer = document.querySelectorAll('.choixPlayer_monPlayer'); 
    lienChangementMusiquePlayer[0].firstChild.addEventListener('click', function(e) {Player_changementMusique(e);}, false);
//    alert(lienChangementMusiquePlayer.firstChild);

</script>

<!-- SECTION : Ajoute une musique à la liste de lecture -->
<script>
    function Player_ajoutMusiqueLL(clicLienPlayer) {
        // Lien youtube
        var lienYoutube = clicLienPlayer.target.nextElementSibling;
        lienYoutube = lienYoutube.href;
        // Il y a 3 types de liens donc on doit trouver dans quel cas on se trouve: http, https, ou localhost...
        lienYoutube = lienYoutube.replace(/[a-z0-9\.:\/_]*www\.youtube\.com\/watch\?v=/,"http://www.youtube.com/embed/");


        
        // Nom de l'artiste
        var nomArtiste = document.querySelector('.titreFenetreLiensMusiqes');
        nomArtiste = nomArtiste.firstElementChild.firstElementChild.innerHTML;
        
        // Nom de la musique
        var nomMusique = document.querySelector('.nomMusiqueChoixPlayer');
        nomMusique = nomMusique.innerHTML;

        // On ajoute a la liste de lecture
        var lienListeLecture = document.querySelectorAll('.ligneListeLecture');
        var longeurLL = lienListeLecture.length;
        
        
        // On cherche une ligne vide de la LL
        var caseVideTrouve = 0;
        for(var recherche = 0; recherche < longeurLL; recherche++){

            if(lienListeLecture[recherche].firstElementChild.innerHTML.length == 0){
//                alert(lienListeLecture[recherche].firstElementChild.innerHTML);
                caseVideTrouve = recherche;
                
                // On sort de la boucle
                recherche = longeurLL;
            }
        }
        
        if(caseVideTrouve < longeurLL){
            lienListeLecture[caseVideTrouve].firstElementChild.href = lienYoutube;
            lienListeLecture[caseVideTrouve].firstElementChild.innerHTML = nomMusique + "<br/> " + nomArtiste;
        }


//        // On masque le player
//        var lienFenetrePlayer = document.querySelector('.player_fenetreVideo'); 
//        lienFenetrePlayer.style.display = "none";
//
//        //On affichage  la LL
//        lienFenetrePlayer = document.querySelector('.player_fenetreListeLecture'); 
//        lienFenetrePlayer.style.display = "block";


    }



    // Bouton de changement de musique du player + de son affichage
    var lienChangementMusiquePlayer = document.querySelectorAll('.choixPlayer_monPlayer'); 
    lienChangementMusiquePlayer[1].firstChild.addEventListener('click', function(e) {Player_ajoutMusiqueLL(e);}, false);
    //    alert(lienChangementMusiquePlayer.firstChild);

</script>

<!-- SECTION : Changement des blocs: ajout musique / suppression musique -->
<script> 
    function changeToAjoutMusique() {
        var lienDepart = document.querySelector('.blocBasArticle');
        var lienFenetre1 = lienDepart.firstElementChild;
        var lienFenetre2 = lienFenetre1.nextElementSibling;
        lienFenetre1.className = "fenetreCachee";
        lienFenetre2.className = "fenetreAffichee";
    }

    function changeToOriginalMenu() {
        var lienDepart = document.querySelector('.blocBasArticle');
        var lienFenetre1 = lienDepart.firstElementChild;
        var lienFenetre2 = lienFenetre1.nextElementSibling;
        lienFenetre1.className = "fenetreAffichee";
        lienFenetre2.className = "fenetreCachee";
    }

    // On affecte les fonctions aux différents blocs.
    // Ce lien permet de changer les blocs vers ajoutMusique
    var lienDepart = document.querySelector('.blocBasArticle'); 
    var lienAjoutMusique = lienDepart.firstElementChild.firstElementChild;
    lienAjoutMusique.addEventListener('click', changeToAjoutMusique, false);

    // Ce lien permet de retourner aux blocs de base
    var lienRetour = lienDepart.firstElementChild.nextElementSibling.firstElementChild.nextElementSibling;
    lienRetour.addEventListener('click', changeToOriginalMenu, false);
</script>




<!-- BLOC DROIT : Affiche/masque les blocs: ajout musique / chat / ... -->
<script> 
    function blocsBanniere_afficheOuCache(lienDepart) {
        lienDepart = lienDepart.target.nextElementSibling;
        var lienFenetre = lienDepart;
        if(lienFenetre.style.height == "0px") {
            lienFenetre.style.height = "auto";
            lienFenetre.style.visibility = "visible";
        } else {
            lienFenetre.style.visibility = "hidden";
            lienFenetre.style.height = "0px";
        }
    }



    // On affecte les fonctions aux différents blocs.
    // Ce lien permet de changer les blocs vers ajoutMusique
    var lienFenetres = document.querySelectorAll('.visibilite'); 
    //    alert(lienFenetres[0].innerHTML);
    lienFenetres[0].previousElementSibling.addEventListener('click', function(e) {blocsBanniere_afficheOuCache(e);}, false);
    lienFenetres[1].previousElementSibling.addEventListener('click', function(e) {blocsBanniere_afficheOuCache(e);}, false);


</script>

<!-- BLOC DROIT: affiche ou cache les blocs ajout musique / chat / dernieres musiques ajoutees -->
<script> 

    function bloc_afficheOuCache(lienDepart) {
        lienDepart = lienDepart.target;
        var lienFenetre = lienDepart.nextElementSibling;
        if(lienFenetre.style.height == "0px") {
            lienFenetre.style.height = "auto";
            lienFenetre.style.visibility = "visible";
            lienFenetre.previousElementSibling.style.borderWidth = "1px";
        } else {
            lienFenetre.style.visibility = "hidden";
            lienFenetre.style.height = "0px";
            lienFenetre.previousElementSibling.style.borderWidth = "0px";
        }
    }

    function affectationAfficheOuCache(lienBoites) {
        for (var i = 0; i < blocDroit_lienBoites.length; i++) {
            lienBoites[i].addEventListener('click', function(e) {bloc_afficheOuCache(e);}, false);
        }
    }


    // On affecte les fonctions aux différents blocs.
    // Ce lien permet de changer les blocs vers ajoutMusique
    var blocDroit_lienBoites = document.querySelectorAll('.blocDroit_boiteSelector'); 

    affectationAfficheOuCache(blocDroit_lienBoites);


</script>

<!-- PLAYER : Bouton Liste Lecture / Player-->
<script>
    function affichePlayerOuLL(){

        var lienFenetrePlayerVideo = document.querySelector('.player_fenetreVideo'); 
        var bouton = document.querySelector('.boiteBoutonAffichPlayerOuLL'); 
        if(lienFenetrePlayerVideo.style.height == '0px'){
            lienFenetrePlayerVideo.style.height = sessionStorage.getItem("video_height");;// Fenetre Video
            lienFenetrePlayerVideo.nextElementSibling.style.display = 'none';//Fenetre LL
            bouton.firstChild.innerHTML = "Liste de Lecture";
//            alert("block");
            


        }else {
            sessionStorage.setItem("video_height",lienFenetrePlayerVideo.style.height)
            lienFenetrePlayerVideo.style.height = '0px';// Fenetre Video
            lienFenetrePlayerVideo.nextElementSibling.style.display = 'block';//Fenetre LL
            bouton.firstChild.innerHTML = "Player";
            //            alert("none");

        }
    }
    
    // Bouton Player ou Liste Lecture
    var boutonPlayerOuLL = document.querySelector('.boiteBoutonAffichPlayerOuLL'); 
    boutonPlayerOuLL.firstChild.addEventListener('click', function(e) {affichePlayerOuLL();}, false);
</script>

<!-- PLAYER : Quand une musique fini, ajoute la suivante sur la LL au Player-->
<script>
     
    function afficheLL(lienDepart){
        var listeDeLecture = document.querySelectorAll('.ligneListeLecture');
//        listeDeLecture = listeDeLecture[0].innerHTML;

        if(listeDeLecture[0].firstElementChild.innerHTML.localeCompare("")){
            alert(listeDeLecture[0].innerHTML);

        }
    }
   

//    function affichePlayerOuLL(){
//
//        var lienFenetrePlayerVideo = document.querySelector('.player_fenetreVideo'); 
//        var bouton = document.querySelector('.boiteBoutonAffichPlayerOuLL'); 
//        if(lienFenetrePlayerVideo.style.height == '0px'){
//            lienFenetrePlayerVideo.style.height = sessionStorage.getItem("video_height");;// Fenetre Video
//            lienFenetrePlayerVideo.nextElementSibling.style.display = 'none';//Fenetre LL
//            bouton.firstChild.innerHTML = "Liste de Lecture";
////            alert("block");
//            
//
//
//        }else {
//            sessionStorage.setItem("video_height",lienFenetrePlayerVideo.style.height)
//            lienFenetrePlayerVideo.style.height = '0px';// Fenetre Video
//            lienFenetrePlayerVideo.nextElementSibling.style.display = 'block';//Fenetre LL
//            bouton.firstChild.innerHTML = "Player";
//            //            alert("none");
//
//        }
//    }
//    
//    // Bouton Player ou Liste Lecture
    var listeDeLecture = document.querySelectorAll('.ligneListeLecture'); 
    listeDeLecture[0].addEventListener('click', function(e) {afficheLL();}, false);

    
    function affichePlayer(bla){
        alert('is playing');
    }
    
    var listeVideoPlayer = document.querySelector('.player_fenetreVideo'); 
    listeVideoPlayer.firstElementChild.addEventListener('play', function(e) {affichePlayer();}, false);

</script>

<!-- PLAYER : Quand une musique fini, ajoute la suivante sur la LL au Player-->
<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
//    tag.src = "http://www.youtube.com/embed/YlUKcNNmywk";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player_scriptVideo', {
            height: '100%',
            width: '100%',
            videoId: 'M7lc1UVf-VE',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
    
//    var iframe_video = document.querySelector('.player_fenetreVideo');
//    lienVideo = iframe_video.firstElementChild.src;
//    alert(iframe_video.firstElementChild.src);


    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
//        event.target.playVideo();
        
            var iframe_video = document.querySelector('.player_fenetreVideo');
            lienVideo = iframe_video.firstElementChild;
            lienVideo.src = "http://www.youtube.com/embed/YlUKcNNmywk";
//            alert(lienVideo.src);
        
        var iframe_video = document.querySelector('.player_fenetreVideo');
//        alert(iframe_video.parentNode.innerHTML);
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
//        alert('blabla');
//        alert(event.data);
        if (event.data == YT.PlayerState.ENDED ) {
//            alert(event.data);
//            setTimeout(stopVideo, 6000);
            done = true;
            
            // Liste de lecture
            var listeDeLecture = document.querySelectorAll('.ligneListeLecture');
            var ligneLL = listeDeLecture[0].firstChild.href;
//            alert(ligneLL);
            
            
            var iframe_video = document.querySelector('.player_fenetreVideo');
            lienVideo = iframe_video.firstElementChild;
            alert(lienVideo.src);

            lienVideo.src = ligneLL;
            alert(lienVideo.src);
        }
    }
//    function stopVideo() {
//        player.stopVideo();
//    }
    
    
    var iframe_video = document.querySelector('.player_fenetreVideo');
//    alert(iframe_video.parentNode.innerHTML);

    
</script>






<!-- DRAG AND DROP -->
<script> // Script permettant le drag and drop
    (function() { // On utilise une IIFE pour ne pas polluer l'espace global
        var storage = {}; // Contient l'objet de la div en cours de déplacement

        function init() { // La fonction d'initialisation
            var elements = document.querySelectorAll('.draggableBox'),
                elementsLength = elements.length;

            for (var i = 0 ; i < elementsLength ; i++) {
                elements[i].addEventListener('mousedown', function(e) { // Initialise le drag & drop
                    var s = storage;
                    s.target = e.target;
                    s.offsetX = e.clientX - s.target.offsetLeft;
                    s.offsetY = e.clientY - s.target.offsetTop;
                }, false);

                elements[i].addEventListener('mouseup', function() { // Termine le drag & drop
                    storage = {};
                }, false);
            }

            document.addEventListener('mousemove', function(e) { // Permet le suivi du drag & drop
                var target = storage.target;

                if (target) {
                    target.style.top = e.clientY - storage.offsetY + 'px';
                    target.style.left = e.clientX - storage.offsetX + 'px';
                }
            }, false);
        }

        init(); // On initialise le code avec notre fonction toute prête.
    })();
</script>




<!-- DRAG AND DROP 2 ? -->
<script> 
    (function() { // On utilise une IIFE pour ne pas polluer l'espace global
        var storage = {}; // Contient l'objet de la div en cours de déplacement

        function init() { // La fonction d'initialisation
            var elements = document.querySelectorAll('.draggableBox'),
                elementsLength = elements.length;

            for (var i = 0 ; i < elementsLength ; i++) {
                elements[i].addEventListener('mousedown', function(e) { // Initialise le drag & drop
                    var s = storage;
                    s.target = e.target;
                    s.offsetX = e.clientX - s.target.offsetLeft;
                    s.offsetY = e.clientY - s.target.offsetTop;
                }, false);

                elements[i].addEventListener('mouseup', function() { // Termine le drag & drop
                    storage = {};
                }, false);
            }

            document.addEventListener('mousemove', function(e) { // Permet le suivi du drag & drop
                var target = storage.target;

                if (target) {
                    target.style.top = e.clientY - storage.offsetY + 'px';
                    target.style.left = e.clientX - storage.offsetX + 'px';
                }
            }, false);
        }

        init(); // On initialise le code avec notre fonction toute prête.
    })();
</script>