<h2>Generer des périodes d'essai</h2>

<form method="POST" action="#">
    <label>
        Departement :
        <select name="Departement">
        <option value="Inconue" > -------------- </option>
            <?php foreach ($Dep as $res): ?>
                <option value=<?= $res['INSEE_Departement'] ?>> <?= $res['nomDepartement'] ?> </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>
        Nombre de mois totale :
        <input type="number" name="moisT" placeholder="Nombre de mois" min=3>
    </label>
    <label for="km">
        Nombre de kilomètres :
        <input type="number" name="km" placeholder="Nombre de kilomètres" min=0>
    </label>
    <input type="submit" name="boutonGenerer" value="Generer"/>
    <br>
    <ul>
        <?= $mes ?>
    </ul>
</form>