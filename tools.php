<?php
/*
	CONNEXION A LA BDD
*/
function BddConnect(){
    $typeDeConnexion = "local";
//    $typeDeConnexion = "serveur";
    
    
	try {
        if(!strcmp($typeDeConnexion,"local")){
            $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 			
        } else {
            $bdd = new PDO('mysql:host=db567390711.db.1and1.com;dbname=db567390711', 'dbo567390711', '09091990tintin',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        }			
	}catch(Exception $e) {
		die('Erreur : '.$e->getMessage()); 
	}
	
	return $bdd;
}









?>