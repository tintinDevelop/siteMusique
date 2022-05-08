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
		<link rel="stylesheet" href="footer/styleFooter.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mon premier site</title> 
	</head>
			
				<?php 
				include_once('tools.php');
				$bdd = BddConnect();
				
				// On recupere le nombre de musiques de la BD
				$reponse = $bdd->query('SELECT artiste,titre FROM bibliotheque');	
				$compteur = 0;
				while($donnees = $reponse->fetch()) {
					$compteur++;
				}
				$reponse->closeCursor();
				 // echo $compteur;
				
				// On saute les autres musiques
				$reponse = $bdd->query('SELECT artiste,titre FROM bibliotheque');
				for($curseur = 0; $curseur <= $compteur - 4; $curseur++) {
					$donnees = $reponse->fetch();
				}
				
				// On affiche uniquement les 5 derniers
				for($curseur = 0; $curseur < 4; $curseur++) {
					$artisteMajuscule = strtoupper($donnees['artiste']);
                    echo "<span class=\"titreListeArtistes policeChunkFive\">$artisteMajuscule</span>   " . $donnees['titre'] . "<br/>";
					$donnees = $reponse->fetch();
				}
				
				?>	
</html> 