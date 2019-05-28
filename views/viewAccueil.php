<div class="center">
    <form action="<?= URL?>?url=databases" method="post" class="center">
        <label for="ip" class="right">IP :</label><input type="text" name="ip" /><br />
        <label for="user" class="right">User :</label><input type="text" name="user" /><br />
        <label for="password" class="right">Password :</label><input type="text" name="password" /><br />
        <label for="table" class="right"></label><input type="hidden" name="table" value="" /><br />
        <label for="database" class="right"></label><input type="hidden" name="database" value="" /><br />
        <input type="hidden" name="rowid" value="">
        <label for="button" class="right" style="margin-top:10px;"><input type="submit" value="Valider" class="center" /><br />
    </form>
</div>
<hr>

<div class="center">
    <form action="?url=APropos" method="post" class="center">
        <label for="button" class="right" style="margin-top:10px;"><input type="submit" value="À Propos" class="center" /><br />
    </form>
</div>