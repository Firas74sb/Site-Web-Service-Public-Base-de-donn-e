<h2>Ajout d'un Service</h2>
<p>Ici vous pouvez ajouter un service poour une ou plusieurs Communes.</p><br>

<form method="POST" action="#">
	<label>
		Services :
		<select name="Service[]" multiple="True">
			<?php foreach ($Service as $res): ?>
				<option value=<?= $res['idService'] ?>> <?= $res['type_Service'] ?> </option>
			<?php endforeach; ?>
		</select>
	</label>
	<label>
		Communes :
		<select name="Commune[]" multiple="True">
			<?php foreach ($Commune as $res): ?>
				<option value=<?= $res['INSEE_Commune'] ?>><?= $res['nomCommune'] ?></option>
			<?php endforeach; ?>
		</select>
	</label>

	<input type="submit" name="boutonValider" value="Ajouter"/>

	<br>
	<ul>
		<?= $add ?>
	</ul>
</form>
