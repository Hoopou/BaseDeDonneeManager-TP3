<div class="center">
    <table>
        <!-- <tr>
            <th>Tables</th>
            <th>Selectionner</th>
        </tr> -->
        <?php var_dump($table)?>
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
                        <input type="submit" value="Selectionner" name="action" class="center" />
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