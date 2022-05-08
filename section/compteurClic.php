<?php
/*
    Ce fichier mets a jour les données sur les liens de la bibliotheque:
        - Le nombre de fois où la musique a étée écouté: nbr_vues
        - La date de derniere lecture: date_derniere_lecture 

*/


// On vérifie que toutes les informations ont été remplies
if(isset($_GET['lien'])) {

    include_once('../tools.php');
    $bdd = BddConnect();

    
    
    $lien = $_GET['lien'];

    //On vérifie qu'il n'y a pas de chaine de caractère vide lorsqu'on ajoute les données
    if(strcmp($lien, "")) {  

        
        $reponse = $bdd->prepare('SELECT artiste,titre,lien,nbr_vues FROM bibliotheque WHERE lien = ?');	
        $reponse->execute(array($lien));
        
        $donnees = $reponse->fetch();

//        echo "Ce lien a ete consulte " . $donnees['nbr_vues'] . " fois";
        $reponse->closeCursor();
        
        $nouveau_nbr_vues = $donnees['nbr_vues'] + 1;
        
//        echo $nouveau_nbr_vues;
        
        $req = $bdd->prepare('UPDATE bibliotheque SET nbr_vues = :nouveau_nbr_vues, date_derniere_lecture = NOW() WHERE lien = :donne_lien');
        $req->execute(array(
            'nouveau_nbr_vues' => $nouveau_nbr_vues,
            'donne_lien' => $lien
        ));


        //htmlspecialchars
        //strtoupper
    }



}


//header("Location: ../html07.php");
header("Location: $lien");

?>