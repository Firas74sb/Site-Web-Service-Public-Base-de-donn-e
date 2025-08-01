<?php 
/***** Fonctions de Connexion et Deconnexion à la BD *****/
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	mysqli_query($connexion,'SET NAMES UTF8'); // noms en UTF8
	return $connexion;
}
function deconnectBD($connexion) {
	mysqli_close($connexion);
}
/*=======================================================*/

// Renvoie tous les instances d'une table passé en paramétre
function Instance ($connexion, $nomTable) {
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}
// Nombre d'instances d'une table passé en paramétre
function countInstances ($connexion, $nomTable) {
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$row = mysqli_fetch_assoc($res);
	return $row['nb'];
}
// Nom des enfant avec leur école
function EnfantEcole ($connexion) {
	$requete = "SELECT idEnfant, nomEnfant, prenomEnfant, nomLieu
	FROM ENFANT NATURAL JOIN LIEUX
	ORDER BY idEnfant";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
// Renvoie si elle existe la date soumis par le formulaire sinon le "01/01/2024"
function dateM () {
	if (isset($_POST['Date'])) return $_POST['Date'];
	else return '2024-01-01';
}
// Liste des Enfants avec la cantine ou ils mangeront à une date précise
function EnfantMange ($connexion, $date) {
	$requete = "SELECT e.idEnfant, nomEnfant, prenomEnfant, nomCantine, '$date'
	FROM ENFANT e LEFT JOIN MANGER m
	ON e.idEnfant = m.idEnfant
	LEFT JOIN CANTINE c ON c.idCantine = m.idCantine
	WHERE '$date' BETWEEN dateDebut AND dateFin";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
// Enfant avec le même nom, prenom mais dans des ecoles différentes
function pairesEnfant ($connexion) {
	$requete = "SELECT DISTINCT e1.nomEnfant, e2.prenomEnfant, l1.nomLieu, l2.nomLieu
	FROM ENFANT e1 NATURAL JOIN LIEUX l1, ENFANT e2 NATURAL JOIN LIEUX l2 
	WHERE e1.nomEnfant = e2.nomEnfant
	AND e1.prenomEnfant = e2.prenomEnfant
	AND e1.idLieu != e2.idLieu
	GROUP BY nomEnfant";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
//? Top 3 des Departement avec le plus de commune
function Top3DepartCommune ($connexion) {
	$requete = "SELECT nomDepartement, COUNT(*)
	FROM DEPARTEMENT d LEFT JOIN COMMUNE c
	ON d.INSEE_Departement = c.INSEE_Departement
	GROUP BY nomDepartement
	ORDER BY COUNT(*) DESC
	LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
// Top 3 des Service avec les plus demandés par les citoyens
function Top3ServiceDemande ($connexion) {
	$requete = "SELECT type_Service, COUNT(d.idService)
	FROM DEMANDE d RIGHT JOIN SERVICE s
	ON d.idService = s.idService
	GROUP BY type_Service
	ORDER BY COUNT(d.idService) DESC
	LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
// Top 3 des Service les plus propose par les Communes
function Top3ServicePropose ($connexion) {
	$requete = "SELECT type_Service, COUNT(p.idService)
	FROM PROPOSE p RIGHT JOIN SERVICE s
	ON p.idService = s.idService
	GROUP BY type_Service
	ORDER BY COUNT(p.idService) DESC
	LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}
// Top 3 des Communes avec les plus d'union
function Top3CommuneUnion ($connexion) {
	$requete = "SELECT nomCommune, COUNT(d.idService)
	FROM COMMUNE c LEFT JOIN DEMANDE d
	ON c.INSEE_Commune = d.INSEE_Commune
	WHERE idService = 5
	GROUP BY nomCommune
	ORDER BY COUNT(d.idService) DESC
	LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res);
	return $instances;
}

// Booléen pour savoir si un service est déja proposé par une Commune
function EstPropose ($Insee, $idS, $connexion) {
	$requete = "SELECT COUNT(*) AS nb
	FROM PROPOSE
	WHERE INSEE_Commune = $Insee AND idService = $idS";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_assoc($res);
	if($instances['nb'] == 0) return FALSE;
	else return TRUE;
}
// Retourne le nom d'une instances selon sa clé
function nomDeS ($connexion, $cle) {
	$requete = "SELECT type_Service
	FROM SERVICE WHERE idService = $cle";
	$res = mysqli_query($connexion, $requete);
	$row = mysqli_fetch_assoc($res);
	return $row['type_Service'];
}
// Retourne le nom d'une instances selon sa clé
function nomDeC ($connexion, $cle) {
	$requete = "SELECT nomCommune
	FROM COMMUNE WHERE INSEE_Commune = $cle";
	$res = mysqli_query($connexion, $requete);
	$row = mysqli_fetch_assoc($res);
	return $row['nomCommune'];
}

//Ajout d'un service
function AjouterS ($connexion) {
	$res = "";
	if (!isset($_POST['boutonValider'])) {
		$res = $res."<li><b>Appuyer pour ajouter</b></li>";
		return $res;
	}
	if (!isset($_POST['Service'])) {
		$res = $res."<li><mark>Erreur : Selectionez au moin un service !</mark></li>";
		return $res;
	}
	if (!isset($_POST['Commune'])) {
		$res = $res."<li><mark>Erreur : Selectionez au moin une commune !</mark></li>";
		return $res;
	}
	foreach ($_POST['Commune'] as $Insee) {
		foreach ($_POST['Service'] as $idS) {
			$nomS = nomDeS($connexion, $idS);
			$nomC = nomDeC($connexion, $Insee);
			if (EstPropose($Insee, $idS, $connexion))
				$res = $res."<li><mark>Erreur : Le service $nomS est deja présent dans la commune  $nomC</mark></li> \n";
			else {
				$requete = "INSERT INTO PROPOSE VALUES ($Insee, $idS, NULL)";
				mysqli_query($connexion, $requete);
				$res = $res."<li>Le service <font color=red>$nomS</font> a bien été ajouer à la commune $nomC</li> \n";
			}
		}
	}
	return $res;

}

//Intégration des donnés
// Booléen pour savoir si une commune est déja dans la BD
function EstDansC ($cle, $connexion) {
	$requete = "SELECT COUNT(*) AS nb
	FROM COMMUNE
	WHERE INSEE_Commune = $cle";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_assoc($res);
	if($instances['nb'] == 0) return FALSE;
	else return TRUE;
}
// Booléen pour savoir si un département est déja dans la BD
function EstDansD ($cle, $connexion) {
	$requete = "SELECT COUNT(*) AS nb
	FROM DEPARTEMENT
	WHERE INSEE_Departement = $cle";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_assoc($res);
	if($instances['nb'] == 0) return FALSE;
	else return TRUE;
}
function Integration ($connexion) {
	$message = "";
	$nbDep = 0;
	$nbCom = 0;
	if (isset($_POST['boutonValider'])) {
		$requete = "SELECT DISTINCT *
		FROM dataset.Communes
		WHERE code_region = 84";
		$res = mysqli_query($connexion, $requete);
		$instances = mysqli_fetch_all($res); //Recupération des Instances des Communes de Auv-Rh-Al
		foreach($instances as $i) {
			if (!EstDansD($i[6], $connexion)) {
				$requete = "INSERT INTO DEPARTEMENT VALUES ('$i[6]', '$i[7]', '$i[8]')";
				mysqli_query($connexion, $requete);
				$nbDep = $nbDep + 1;
			}
			if (!EstDansC($i[0], $connexion)) {
				$i_5 = str_replace("'", "\'", $i[5]); //Résoue le probléme des communes qui ont un aposthrophes(')
				$requete = "INSERT INTO COMMUNE VALUES ('$i[0]', '$i_5', '$i[1]', '$i[2]', '$i[3]', '$i[6]')";
				mysqli_query($connexion, $requete);
				$nbCom = $nbCom + 1;
			}
		}
		$message = $message."<li>$nbDep département ont été rajouter à la base</li> \n";
		$message = $message."<li>$nbCom communes ont été rajouter à la base</li> \n";
	}
	else $message = $message."<li>Veuillez appuyer sur le bonton pour faire l'intégration !</li>";
	return $message;
}

function selecService ($connexion, $nbS) {
	$requete = "SELECT * FROM SERVICE
	ORDER BY RAND() LIMIT $nbS";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function selecCommmune ($connexion, $limit, $Dep) {
	$requete = "SELECT * FROM COMMUNE ORDER BY RAND() LIMIT $limit";
	if(is_numeric($Dep)) $requete = "SELECT * FROM COMMUNE WHERE INSEE_Departement = $Dep ORDER BY RAND() LIMIT $limit";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function generer ($connexion, $nbS, $nbCom) {
	$message = "";
	if(isset($_POST['boutonGenerer'])) {
		$Dep = $_POST['Departement'];
		$nbCom = rand(5, 20);
		$nbS = rand(3, 5);
		$dureeT = array(3, 4, 6);
		$duree = $dureeT[(rand(0, 2))];
		if(is_numeric($_POST['moisT'])) {
			$moisT = $_POST['moisT'];
			$min2 = intdiv($moisT, $duree*$nbS);
			$limit = min($nbCom, $min2);
		}
		else $limit = $nbCom;
		
		$Service = selecService($connexion, $nbS);
		$Commune = selecCommmune($connexion, $limit, $Dep);
		foreach ($Service as $s) {
			$message = $message."<li>Le service <font color=red>$s[type_Service]</font> est en période d'éssai pour les communes : ";
			foreach ($Commune as $c) {
				$requete = "INSERT INTO PROPOSE VALUES ($c[INSEE_Commune], $s[type_Service], $duree)";
				mysqli_query($connexion, $requete);
				$message = $message."<font color=green>$c[nomCommune]</font>, ";
			}
			$message = $message."pour une période de <font color=red>$duree</font> mois.</li> \n";
		}
	}
	return $message;
}

?>