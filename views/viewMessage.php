<div class="center">
    <h3 style="color:red;"><?=$message?></h3>
    <form action="<?= URL ?>?url=rows" method="post" class="center">
        <?php require('templateUserData.php'); ?>
        <input  type="submit" value="REVENIR" name="action" class="center" />
    </form>

</div>