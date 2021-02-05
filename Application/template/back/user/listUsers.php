<?php $title = 'Liste des utilisateurs'; ?>

<section >
    <header class="mb-3 mb-md-5">
        <h2>Liste des utilisateurs</h2>
    </header>

    <?php if ($users) : ?>
    <div class="table-responsive">
        <table class="table">
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
                    <tr class="<?php if (! $user->getIsValide()) : escHtml('bg-not-valide'); endif; ?>">
                        <td><?php escHtml($i) ?></td>
                        <td><a href="/admin/user/<?php escHtml($user->getId()) ?>"><?php escHtml($user->getPseudo()) ?></a></td>
                        <td><?php escHtml($user->getIsValide() ? 'Oui' : 'Non') ?></td>
                    </tr>
                <?php
                $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</section>