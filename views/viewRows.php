<div class="center">
    <table>
         <tr>
            <?php foreach ($table->arrayColumns() as $columns) : ?>
                <th><?= $columns->name()?></th>
            <?php endforeach; ?>
            <th> Modifier</th>
            <th> Supprimer</th>
        </tr> 
        <?php foreach ($table->arrayRow() as $row) : ?>
            <tr>
            <?php foreach ($row->arrayItems() as $item) : ?>
                    <td>
                        <p><?= $item->value() ?></p>
                    </td>
                <?php endforeach; ?>

                <th>
                    <form action="<?= URL ?>?url=rows" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="submit" value="Modifier" name="action" class="center" />
                    </form>
                </th>

                <th>
                    <form action="<?= URL ?>?url=rows" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="submit" value="Supprimer" name="action" class="center" />
                    </form>
                </th>

            </tr>
        <?php endforeach; ?>
    </table>
</div>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        botto
    }
</style>