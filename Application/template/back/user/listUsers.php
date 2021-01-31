<?php $title = 'Liste des utilisateurs'; ?>

<section class="row">
    <header class="col-12">
        <h2>Liste des utilisateurs</h2>
    </header>

    <?php if ($users) : ?>
    <div class="col-12">
        <table class="table striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Valider</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1 + ($numberPostPerPage * ($numeroPage - 1));
                foreach ($users as $user) : ?>
                    <tr class="<?php if(! $user->getIsValide()) : escHtml('bg-red-100'); endif; ?>">
                        <td><?= $i ?></td>
                        <td><a href="/admin/user/<?php echo $user->getId() ?>"><?= $user->getPseudo() ?></a></td>
                        <td><?= $user->getIsValide() ? 'Oui' : 'Non' ?></td>
                    </tr>
                <?php
                $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</section>