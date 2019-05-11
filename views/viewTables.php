
<div class="center">
    <table>
        <tr>
            <th>Tables</th>
            <th>Selectionner</th>
        </tr>
        <?php foreach($tables as $table):?>
            <tr>
                <td>
                    <p><?= $table->name() ?></p>
                </td>
                <th>
                    <form action="<?= URL?>?url=rows" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="hidden" value="<?= $table->name() ?>" name="table" class="center">
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
     border-collapse: collapse; 
     botto
    }
</style>