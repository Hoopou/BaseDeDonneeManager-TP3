<div class="center">
    <table>
        <?php for ($i = 0; $i < count($table->arrayColumns()); $i++) : ?>
        <tr>
            <td><?= $table->arrayColumns()[$i]->name() ?></td>
            <!-- ICI, le type doit etre le type de la colonne de la table -->
            <td style="padding-right:2%;"><input type="text" value="<?= $_row->arrayItems()[$i]->value() ?>" name="action" class="center" /></td>
            
        </tr>
        <?php endfor; ?>

        <tr>
            <th colspan="<?= count($table->arrayColumns())+2?>">
                <form action="<?= URL ?>?url=ConfirmerModifier" method="post" class="center">
                    <?php require('templateUserData.php'); ?>
                    <input style="background-color: lightgreen;" type="submit" value="Confirmer" name="action" class="center" />
                </form>
            </th>
        </tr>
    </table>
</div>