<?php $title = "Article"; ?>

<h2>Article <?php escHtml($post->getTitle()); ?></h2>

<?php

if ($comments) : 
    foreach($comments as $comment) : ?>

    <p><?php escHtml($comment->getAutor()->getPseudo());?></p>
    <p><?php escHtml($comment->getContent());?></p>
    <p><?php escHtml($comment->getCreatedAt()->format('d m Y'));?></p>
    <p>
        <a href="/comment/edit/<?php escHtml($comment->getId()) ?>">Modifier</a>
        <a href="/comment/delete/<?php escHtml($comment->getId()) ?>">Supprimer</a>
    </p>
    <hr>

    <?php endforeach; 
endif;

if ($form) {
    escHtml($form);
}
