<?php $title = 'Liste des utilisateurs'; ?>

<h2>Liste des utilisateurs</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Pseudo</th>
            <th>Confirmé ?</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($users as $user) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><a href="/admin/user/<?php echo $user->getId() ?>"><?= $user->getPseudo() ?></a></td>
                <td><?= $user->getIsValide() ? 'Oui' : 'Non' ?></td>
            </tr>
        <?php
        $i++;
        endforeach; ?>
    </tbody>
</table>
