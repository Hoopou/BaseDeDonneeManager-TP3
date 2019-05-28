<div class="center">
    <table>
        <tr>
            <?php foreach ($table->arrayColumns() as $columns) : ?>
                <th><?= $columns->name().' ['.$columns->type().']'?></th>
            <?php endforeach; ?>
            <th> Modifier</th>
            <th> Supprimer</th>
        </tr> 
    <!-- #region displayDate -->
        <?php foreach ($table->arrayRow() as $row) : ?>
            <tr>
            <?php foreach ($row->arrayItems() as $item) : ?>
                <td>
                    <p>
                        <?=Type::getcustomType($item->type()) == 'file'?>
                        <?php if(strlen($item->value()) >100 ):?>
                        <?=$item->type().' [CONTENT]'?>

                        <?php else:?>
                        <?=$item->value()?>
                        <?php endif; ?>
                    </p>
                </td>
                <?php endforeach; ?>

                <td>
                    <form action="<?= URL ?>?url=ModifierRow" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="hidden" name="rowid" value="<?=$row->myid()?>">
                        <input type="submit" value="Modifier" name="action" class="center" />
                    </form>
                </td>

                <td>
                    <form action="<?= URL ?>?url=SupprimerRow" method="post" class="center">
                        <?php require('templateUserData.php'); ?>
                        <input type="hidden" name="rowid" value="<?=$row->myid()?>">
                        <input type="submit" value="Supprimer" name="action" class="center" />
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    <!-- #endregion -->
        <tr>
            <th colspan="<?= count($table->arrayColumns())+2?>">
                <form action="<?= URL ?>?url=AjouterRow" method="post" class="center">
                    <?php require('templateUserData.php'); ?>
                    <input type="submit" value="Ajouter" name="action" class="center" />
                </form>
            </th>
        </tr>



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