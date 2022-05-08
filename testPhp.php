<?php
// AFFICHAGE D'IMAGE
//header ("Content-type: image/png");
//
//$image = imagecreate(200,50);
//
//$orange = imagecolorallocate($image,255,128,0);
//$bleu = imagecolorallocate($image,0,0,255);
//
//imagestring($image,2,35,5,"Salut TinTin",$bleu);
//imagecolortransparent($image,$orange);
//imagepng($image);



//REGEX
$chaine1 = "blabla";
$recherche = "#bla#";

$chaine1 = "thomas";
$recherche = "#^tho*[a-z]#";

$chaine1 = "thomas";
$recherche = "#^t*[a-z]{4}s$#";

$chaine1 = "thomas";
$recherche = "#^t*[a-z]{3,}s$#";

if(preg_match($recherche,$chaine1)) {
    echo "Bien joue !";
}else {
    echo "fail bolosse";
}



?>