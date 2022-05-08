<?php
    include_once('twig/lib/Twig/Autoloader.php');
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
?>

<html>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8" />
</html>



<?php

    echo $twig->render('index.twig', array('moteur_name' => 'web'));

?>