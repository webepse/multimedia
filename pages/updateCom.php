<h1>Modifier commentaire</h1>
<form action="treatUpdateCom.php?id=<?= $donIdCom['id'] ?>" method="POST">
    <div class="form-group">
        <textarea name="com" id="" cols="30" rows="10"><?= $donIdCom['texte'] ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Modifier">
    </div>
</form>