<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 08/04/2016
 * Time: 10:31
 */
?>
<table>
    <tr>
        <th>id</th>
        <th>description</th>
        <th>implementor Id</th>
        <th>deadline</th>
        <th>status</th>
    </tr>

    <?php
    //-----------------------------
    foreach ($actions as $action) {
//-----------------------------
        ?>
        <tr>
            <td><?= $action->getId() ?></td>
            <td><?= $action->getDescription() ?></td>
            <td><?= $action->getImplementorId() ?></td>
            <td><?= $action->getDeadline() ?></td>
            <td><?= $action->getStatus() ?></td>
        </tr>
        <?php
//-----------------------------
    }
    //-----------------------------
    ?>
</table>