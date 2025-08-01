<?php
///Calcul des instances
$Reg = countInstances($connexion, "REGION");
$Com = countInstances($connexion, "COMMUNE");
$Enf = countInstances($connexion, "ENFANT");
$EnfantEcole = EnfantEcole($connexion);
$date = dateM();
$EnfantMange = EnfantMange($connexion, $date);
$pEnfant = pairesEnfant($connexion);
$TopD = Top3DepartCommune($connexion);
$TopS = Top3ServiceDemande($connexion);
$TopSP = Top3ServicePropose($connexion);
$TopCU = Top3CommuneUnion($connexion);
?>