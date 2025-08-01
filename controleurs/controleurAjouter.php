<?php
$Service = Instance($connexion, "SERVICE");
$Commune = Instance($connexion, "COMMUNE");
$add = AjouterS($connexion,  $Service, $Commune);
?>