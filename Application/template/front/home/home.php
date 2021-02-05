<?php $title = "Bienvenue !"; ?>

<section>
    <header class="mb-3 mb-md-4">
        <h2>Bienvenue sur ce blog ! </h2>
    </header>

    <!-- intro -->
    <div class="mb-5">
        <p>
            Je me présente je m'appelle <a href="https://www.linkedin.com/in/geoffroy-colpart/" target="_blank">Geoffroy COLPART</a>, je suis développeur web.<br>
            J'ai réalisé ce site lors de ma formation chez <a href="https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony" target="_blank">Openclassrooms</a>, développeur d'application PHP / Symfony.
        </p>
        <p>
            Le but de ce projet était de réaliser un blog entièrement en PHP, sans l'utiliation de framework php ou libraries.<br>
            Le seul framework que j'ai pu utilisé est celui de Bootstrap 5.
        </p>
        <p>
            Ce blog me servira à présenter mes différents projets que j'ai pu réaliser pendant cette foramtion, mais également de présenter mes projets personnels. <br>
            Je vous souhaite une bonne lecture.
        </p>
        <p>PS : Ci-dessous se trouve un formulaire de contact, n'hésitez pas à me laisser un message.</p>
    </div>

    <div>
        <form method="POST" action="/" class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label fw-bold mb-0">Nom</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3 col-md-6">
                <label for="surname" class="form-label fw-bold mb-0">Prénom</label>
                <input type="text" class="form-control" id="surname" name="surname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold mb-0">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label fw-bold mb-0">Votre message</label>
                <textarea class="form-control" id="message" rows="10" name="message"></textarea>
            </div>
            <div class="text-end mt-4">
                <button type="submit" class="text-uppercase btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</section>