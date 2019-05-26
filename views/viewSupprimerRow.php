<div>
    <h4 style="color:red;">Voulez vous vraiment supprimer cette rangée?</h4>
    <table>
        <form action="<?= URL ?>?url=ConfirmerSupprimerRow" method="post" class="center">
            <?php require('templateUserData.php'); ?>
            <?php for ($i = 0; $i < count($table->arrayColumns()); $i++) : ?>
                <tr>
                    <td><?= $table->arrayColumns()[$i]->name() ?></td>
                    <!-- ICI, le type doit etre le type de la colonne de la table -->
                    <td>[<?= $table->arrayColumns()[$i]->type() ?>]</td>
                    <td ><?= $_row->arrayItems()[$i]->value() ?></td>

                </tr>
            <?php endfor; ?>

            <tr>
                <th colspan="<?= count($table->arrayColumns()) + 2 ?>">
                    <input style="background-color: red;" type="submit" value="Supprimer Définitivement la rangée" name="action" class="center" />
                </th>
            </tr>
        </form>
    </table>
</div>