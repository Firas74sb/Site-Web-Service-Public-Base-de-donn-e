<?php
$routes = array(
	'afficher' => array('controleur' => 'controleurAfficher', 'vue' => 'vueAfficher'),
	'integrer' => array('controleur' => 'controleurIntegrer', 'vue' => 'vueIntegrer'),
	'ajouter' => array('controleur' => 'controleurAjouter', 'vue' => 'vueAjouter'),
	'generer' => array('controleur' => 'controleurGenerer', 'vue' => 'vueGenerer')
);

// fichiers statiques
$pathHeader = 'static/header.php';
$pathMenu = 'static/menu.php';
$pathFooter = 'static/footer.php';
$controleurAccueil = 'controleurAccueil';
$vueAccueil = 'vueAccueil';
?>
