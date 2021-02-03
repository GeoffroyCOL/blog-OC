<?php $title = "Liste des articles"; ?>

<?php
if ($posts) : ?>
    <div class="row">
        <?php foreach($posts as $post) : ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
                <article class="card">
                    <header class="ratio ratio-16x9">
                        <img src="<?php escHtml($post->getFeatured()->getUrl()); ?>" alt="">
                    </header>
                    <div class="card-body">
                        <h2 class="card-title fs-4">
                            <a href="/blog/article/<?php escHtml($post->getSlug()); ?>"><?php escHtml($post->getTitle()); ?></a>
                        </h2>
                        <p class="card-text my-4"><?php escHtml(limite_mot($post->getContent(), 25)); ?></p>
                    </div>

                    <footer class="card-footer text-end">
                        <span class="mb-0"><i class="far fa-clock"></i> <?php escHtml($post->getCreatedAt()->format('d/m/Y')); ?></span>
                        <?php if (! isset($category)) : ?>
                            <a href="/blog/categorie/<?php escHtml($post->getCategory()->getSlug()); ?>" class="mb-0 ms-3"><i class="fas fa-tag"></i> <?php escHtml($post->getCategory()->getName()); ?></a>
                        <?php endif; ?>
                    </footer>
                </article>
            </div>
        <?php endforeach;

    if ($pagination) : escHtml($pagination); endif; ?>
    </div>
<?php endif;