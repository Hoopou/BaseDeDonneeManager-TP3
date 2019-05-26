<div class="center">
    <table>
        <form action="<?= URL ?>?url=ConfirmerModifierRow" method="post" class="center">
            <?php require('templateUserData.php'); ?>
            <?php for ($i = 0; $i < count($table->arrayColumns()); $i++) : ?>
                <tr>
                    <td><?= $table->arrayColumns()[$i]->name() ?></td>
                    <!-- ICI, le type doit etre le type de la colonne de la table -->
                    <td>[<?= $table->arrayColumns()[$i]->type() ?>]</td>
                    <td style="padding-right:2%;"><input type="<?= $table->arrayColumns()[$i]->displayableType() ?>" value="<?= $_row->arrayItems()[$i]->value() ?>" name="<?= $table->arrayColumns()[$i]->name() ?>" class="center" /></td>

                </tr>
            <?php endfor; ?>

            <tr>
                <th colspan="<?= count($table->arrayColumns()) + 2 ?>">
                    <input style="background-color: lightgreen;" type="submit" value="Confirmer" name="action" class="center" />
                </th>
            </tr>
        </form>
    </table>
</div>