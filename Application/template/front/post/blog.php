<?php $title = "Liste des articles"; ?>

<h2>Blog</h2>

<?php
if ($posts) : 

    foreach($posts as $post) : ?>
        <p><a href="/blog/article/<?php escHtml($post->getSlug()); ?>"><?php escHtml($post->getTitle()); ?></a></p>
    <?php endforeach; 

endif;