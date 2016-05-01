<?php
/**
 * Created by PhpStorm.
 * User: jr_sa
 * Date: 12/04/2016
 * Time: 16:41
 */
?>

<div class = "tables">
    <h1>List of Users</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Role</th>
        </tr>

        <?php
        //-----------------------------
        foreach ($users as $user) {
            //-----------------------------
            ?>
            <tr>
                <td><?=$user->getId() ?></td>
                <td><?=$user->getUsername() ?></td>
                <td><?=$user->getRole() ?></td>
            </tr>
            <?php
            //-----------------------------
        }
        //-----------------------------
        ?>
    </table>
</div>