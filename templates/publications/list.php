<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 08/04/2016
 * Time: 10:33
 */
?>
<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>author Id</th>
        <th>url</th>
    </tr>

    <?php
    //-----------------------------
    foreach ($publications as $publication) {

        /**
         * @var $publication \Itb\Publication
         */
//-----------------------------
        ?>
        <tr>
            <td><?= $publication->getId() ?></td>
            <td><?= $publication->getTitle() ?></td>
            <td><?= $publication->getAuthorId() ?></td>
            <td>
                <a href="<?= $publication->getUrl() ?>">download</a>
            </td>
        </tr>
        <?php
//-----------------------------
    }
    //-----------------------------
    ?>
</table>