
<div class="center">
    <table>
        <tr>
            <th>Databases</th>
            <th>Selectionner</th>
        </tr>
        <?php foreach($databases as $database):?>
            
            <tr>
                <td>
                    <?= $database->name() ?>
                </td>
                <th>
                    <form action="<?= URL?>?url=tables" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="hidden" value="<?= $database->name() ?>" name="database" class="center">
                        <input type="submit" value="Selectionner" name="action" class="center"/>
                    </form>
                </th>
            </tr>
        <?php endforeach;?>

    </table>
</div>
<style>
    table, th, td {
    border: 1px solid black;
    /* border-collapse: collapse; */
    }
</style>