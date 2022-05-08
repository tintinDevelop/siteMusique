<?php 
session_destroy();
session_start();

if(isset($_POST['pseudoConnexion']) && isset($_POST['mdpConnexion']))
{
    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudoConnexion']);
    $_SESSION['motDePasse'] = htmlspecialchars($_POST['mdpConnexion']);
}
    

header('Location: html07.php');

?>