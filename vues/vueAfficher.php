<h4>Effectif de quelques instances</h4>
<ul>
	<li>Region : <?= $Reg ?></li>
	<li>Communne : <?= $Com ?></li>
	<li>Enfant : <?= $Enf ?></li>
</ul>

<h4>Liste des Enfant avec leur écoles</h4>
<table>
	<tr>
		<th>idEnfant</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Ecole</th>
	</tr>
	<?php foreach ($EnfantEcole as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		<td><?= $res[2] ?></td>
		<td><?= $res[3] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>
	<form method="POST" action="#">
		Liste des Enfant avec la cantine ou ils mangeront le : 
		<input type="date" name="Date" value="2024-01-01" min="2023-09-01" max="2024-08-31">
		<input type="submit" value="Donnez la liste">
	</form>
</h4>
<table>
	<tr>
		<th>idEnfant</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Cantine</th>
		<th>Date</th>
	</tr>
	<?php foreach ($EnfantMange as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		<td><?= $res[2] ?></td>
		<td><?= $res[3] ?></td>
		<td><?= $res[4] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>Paires d’enfants ayant les mêmes nom et prénom, mais inscrits dans des écoles différentes</h4>
<table>
	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Ecole 1</th>
		<th>Ecole 2</th>
	</tr>
	<?php foreach ($pEnfant as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		<td><?= $res[2] ?></td>
		<td><?= $res[3] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>Top 3 Département avec le plus de commune</h4>
<table>
	<tr>
		<th>Nom Departement</th>
		<th>Nombre de communes</th>
	</tr>
	<?php foreach ($TopD as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>Top 3 Service les plus demandés</h4>
<table>
	<tr>
		<th>Nom Service</th>
		<th>Nombre de demande</th>
	</tr>
	<?php foreach ($TopS as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>Top 3 Service les plus proposés</h4>
<table>
	<tr>
		<th>Nom Service</th>
		<th>Nombre de commune</th>
	</tr>
	<?php foreach ($TopSP as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<h4>Top 3 Communes qui font le plus d'union</h4>
<table>
	<tr>
		<th>Nom Commune</th>
		<th>Nombre d'Union</th>
	</tr>
	<?php foreach ($TopCU as $res): ?>
		<tr>
		<td><?= $res[0] ?></td>
		<td><?= $res[1] ?></td>
		</tr>
	<?php endforeach; ?>
</table>