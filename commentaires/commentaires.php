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
echo "<link rel='stylesheet'  href='../styleFeuillePrincipale.css' />";
echo "<link rel='stylesheet'  href='styleCommentaires.css' />";
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mon premier site</title> 
    </head>

    <?php

if(isset($_POST['style5'])) { echo "<body class ='pop'>"; }
else if(isset($_POST['style2'])) { echo "<body class ='rock'>"; }
else if(isset($_POST['style3'])) { echo "<body class ='rap'>"; }
else if(isset($_POST['style4'])) { echo "<body class ='reggae'>"; }
else{ echo "<body>"; }

//include_once("paramPage.class.php");
//$theme = $parametresPage->getTheme();
//echo $theme;
//    echo "<body class =\"$theme\">";



/*
    Transforme les texte des commentaires

    [b][/b] => <strong>
    [i][/i] => <em>
    [color=blue][/color] => <span color="blue">

*/
function transformationTexteREGEX($texte){
    $texte = preg_replace('#\[b\](.+)\[/b\]#i', '<strong>$1</strong>', $texte);
    $texte = preg_replace('#\[i\](.+)\[/i\]#i', '<em>$1</em>', $texte);
    $texte = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $texte);

    return $texte;
}

    ?>

    <!-- HEADER/////////////////////////////// -->
    <?php 
//include("header/header2.php"); 
    ?>
    <!-- Fin Header//////////////////////////// -->

    <?php 
        if(isset($_GET['ID'])) {
            $ID_billet = htmlspecialchars($_GET['ID']);
            
            include_once('../tools.php');
            
//            echo "$ID_billet";
            
            echo "<a href='../html07.php' class='lienRetourSite'>Retour au site</a>";
            
            
            echo "<div class='blocCommentaire fondNoir'>";
                echo "<div class='titreBlocCommentaire policeChunkFive'>Newsletter</div>";
                
            
            
            // FENETRE BILLET
                echo "<div class=\"fenetreBillet fondNoir\">";
                    $bdd = BddConnect();
                    $reponse = $bdd->prepare('SELECT titre,contenu,DATE_FORMAT(date_creation, \'%d-%m-%y à %Hh%i\') AS date_creation FROM billets WHERE ID = ? ');
                    $reponse->execute(array($ID_billet));

                    while ($donnees = $reponse->fetch()) {
                        $ID = $donnees['ID'];
                        $titre = $donnees['titre'];
                        $contenu = nl2br(htmlentities($donnees['contenu']));
                        $date_creation = $donnees['date_creation'];

                        echo "<div class=\"blocTitreBillet policeChunkFive policeRouge fondGris \">$titre &nbsp;&nbsp;&nbsp; $date_creation</div>";
                        echo "<div class=\"blocContenuBillet policeBleue policeKaushan\">$contenu<br /></div>";
                    } 
                    $reponse->closeCursor();
                echo "</div>";
            
            
            
            
            
            // FENETRE COMMENTAIRES
                echo "<div class=\"fenetreCommentaires  fondNoir\">";
                    $bdd = BddConnect();
                    $reponse = $bdd->prepare('SELECT auteur,commentaire,DATE_FORMAT(date_commentaire, \'%d-%m-%y à %Hh%i\') AS date_commentaire FROM commentaires WHERE ID_billet = ? ');
                    $reponse->execute(array($ID_billet));

                    while ($donnees = $reponse->fetch()) {

                        $auteur = htmlspecialchars($donnees['auteur']);
                        $commentaire = nl2br(htmlentities($donnees['commentaire']));
                        $date_commentaire = htmlspecialchars($donnees['date_commentaire']);

                        $commentaire = transformationTexteREGEX($commentaire);
                        
                        echo "<div class=\"blocTitreBillet policeChunkFive policeRouge fondGris\">$auteur &nbsp;&nbsp;&nbsp; $date_commentaire</div>";
                        echo "<div class=\"blocContenuBillet policeBleue policeKaushan\">$commentaire<br /></div>";
                    } 
                    $reponse->closeCursor();
                echo "</div>";
            
            
            
            
            
            
            // FENETRE FORMULAIRE
                echo "<form action=\"ajoutCommentaire.php\" class=\"blocInputComm  fondNoir policeBleue policeKaushan\" method=\"post\">";
                    echo "Pseudo <input type=\"text\" name=\"pseudoComm\" class=\"pseudoInputCommentaire\"/><br />";
                    echo "<input type=\"hidden\" name=\"id_billet\" value=\"$ID_billet\"/>";
                    echo "<textarea name=\"messageComm\" rows=\"5\" cols=\"60\"/>Votre message ici</textarea>";
                    echo "<input type=\"submit\" value=\"GO!\" />";
                echo "</form>";

            
            
            echo "</div>";
           
        }
        
        
    
    ?>
    
    
    
    </body> 
</html>