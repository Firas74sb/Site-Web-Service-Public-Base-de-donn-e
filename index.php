<?php
session_start(); // démarre ou reprend une session
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)
error_reporting(E_ALL); // affiche les erreurs (au cas où)
require('inc/routes.php'); // fichiers de routes
require('inc/includes.php'); // inclut des informations du site (nom, slogan)
require('inc/config-bd.php'); // fichier de configuration d'accès à la BD
require_once('modele/modele.php'); // inclut le fichier modele

$connexion = getConnexionBD(); // connexion à la BD
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $nomSite ?></title> <!-- Titre du navigateur -->
    <link href="<?= $styleCSS ?>" rel="stylesheet" media="all" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="img/icon.svg" />
</head>
<body>
    <?php include($pathHeader); ?>
    <div id="divCentral">
		<?php include($pathMenu); ?>
		<main>
		<?php
		$controleur = $controleurAccueil;
		$vue = $vueAccueil;
		if(isset($_GET['page'])) {
			$nomPage = $_GET['page'];
			if(isset($routes[$nomPage])) {
				$controleur = $routes[$nomPage]['controleur'];
				$vue = $routes[$nomPage]['vue'];
			}
		}
		include('controleurs/' . $controleur . '.php');
		include('vues/' . $vue . '.php');
		?>
		</main>
	</div>
    <?php include($pathFooter); ?>
</body>
</html>