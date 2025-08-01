<h4>Intergration des communnes de Auvergne Rhône-Alpes </h4>
<p>Nombre de Departement dans la base : <?= $Dep ?></p>
<p>Nombre de communes dans la base : <?= $Com ?></p>
<form method="POST" action="#">
    <input type="submit" name="boutonValider" value="Ajouter"/>
    <ul>
        <?= $Res ?>
    </ul>
</form>