<?php
// On vérifie que toutes les informations ont été remplies
if(isset($_POST['artisteAjoute']) && isset($_POST['musiqueAjoute']) && isset($_POST['lienAjoute'])) {
    
    include_once('../tools.php');
    $bdd = BddConnect();
    

    $styleArtiste = "";
    if(!isset($_POST['styleAjoute'])){
        $reponse = $bdd->prepare('SELECT style FROM bibliotheque WHERE artiste = ?');
        $reponse->execute(array(htmlspecialchars($_POST['artisteAjoute'])));
        
        $donnees = $reponse->fetch();
        $styleArtiste = $donnees['style'];
        
        $reponse->closeCursor();
        
    } else {
        $styleArtiste = htmlspecialchars($_POST['styleAjoute']);
    }


     //On vérifie qu'il n'y a pas de chaine de caractère vide lorsqu'on ajoute les données
    if(strcmp($_POST['artisteAjoute'], "") && strcmp($_POST['musiqueAjoute'], "") && strcmp($_POST['lienAjoute'], "")) {  



        $req = $bdd->prepare('INSERT INTO bibliotheque (artiste, titre, lien, style) VALUES(:artiste, :musique, :lien, :style)');

        $req->execute(array(
            'artiste' => htmlspecialchars($_POST['artisteAjoute']),
            'musique' => htmlspecialchars($_POST['musiqueAjoute']),
            'lien'    => htmlspecialchars($_POST['lienAjoute']),
            'style'   => $styleArtiste

        ));
        //echo $_POST['styleAjoute']; 
        //htmlspecialchars
        //strtoupper
    }
    
//    // On transfere les parametres de style
//    foreach ( $_POST as $post => $val )  {            
//        $$post = $val;          //ex:  $post = "styleX"     $val = "Reggae" 
//        echo "<form action=\"../html07.php\" method=\"post\">";
//        if(strpos($post,"style") !== FALSE){
//            //                                    echo $val;
//            echo "<input type=\"hidden\" name=\"$post\" value=\"$val\"/>";
//        }
//        echo "</form>";
//    }
    
            
            
}


header('Location: ../html07.php');

?>