<?php
// On vérifie que toutes les informations ont été remplies
if(isset($_POST['pseudoComm']) && isset($_POST['messageComm']) && isset($_POST['id_billet'])) {

    include_once('../tools.php');
    $bdd = BddConnect();

    $id_billet = htmlspecialchars($_POST['id_billet']);


    //On vérifie qu'il n'y a pas de chaine de caractère vide lorsqu'on ajoute les données
    if(strcmp($_POST['pseudoComm'], "") && strcmp($_POST['messageComm'], "") && strcmp($_POST['id_billet'], "")) {  



        $req = $bdd->prepare('INSERT INTO commentaires (auteur, commentaire, ID_billet,date_commentaire) VALUES(:auteur, :commentaire, :ID_billet, NOW())');

        $req->execute(array(
            'auteur'      => htmlspecialchars($_POST['pseudoComm']),
            'commentaire' => htmlspecialchars($_POST['messageComm']),
            'ID_billet'   => htmlspecialchars($_POST['id_billet'])
         

        ));
       
    }



}


header("Location: commentaires.php?ID=$id_billet");

?>