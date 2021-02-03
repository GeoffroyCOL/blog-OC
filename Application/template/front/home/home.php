<?php $title = "Bienvenue !"; ?>

<section>
    <header class="mb-3 mb-md-4">
        <h2>Bienvenue sur ce blog ! </h2>
    </header>

    <!-- intro -->
    <div class="sections">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil magni neque itaque? Facilis in quaerat explicabo minima omnis!
            Et eveniet nihil suscipit adipisci quisquam eum nam unde obcaecati, ducimus voluptas?Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Nihil magni neque itaque? Facilis in quaerat explicabo minima omnis! Et eveniet nihil suscipit adipisci quisquam eum nam unde obcaecati, ducimus voluptas?
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil magni neque itaque? Facilis in quaerat explicabo minima omnis!
            Et eveniet nihil suscipit adipisci quisquam eum nam unde obcaecati, ducimus voluptas?
        </p>
    </div>

    <!-- Profil -->
    <div class="sections">
        <header class="mb-3 mb-md-4">
            <h2>Profil</h2>
        </header>

        <div class="card shadow border-0 flex-lg-row card-profil m-auto py-3">
            <div class="py-4 text-center col-lg-4 border-bottom border-bottom-lg-0">
                <p><img class="img-fluid img-profil" src="public/img/jojo.png" alt="" ></p>
                <h4 class="fs-2 text-secondary">Geoffroy COLPART</h4>
                <p class="mb-0">Développeur WEB</p>
            </div>

            <div id="profil" class="card-body col-lg-7 offset-lg-1">
                <div class="d-flex align-items-start flex-column">
                    <div class="nav nav-pills pt-2 pb-4 flex-row justify-content-center justify-content-lg-start w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Coordonnées</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Compétences</a>
                    </div>
                </div>
                <div class="tab-content mt-3 mx-2 w-100" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <p class="fs-5">
                            <a class="text-dark" href="https://www.linkedin.com/in/geoffroy-colpart/" target="_blank">
                                <i class="fab fa-linkedin me-3" style="color: #0e76a8"></i> Linkedin
                            </a>
                        </p>
                        <p class="fs-5">
                            <a class="text-dark" href="https://github.com/GeoffroyCOL" target="_blank">
                                <i class="fab fa-github me-3 text-dark"></i> Github
                            </a>
                        </p>
                        <p class="fs-5">
                            <a class="text-dark" href="mailto:geoffroy.colpart81@gmail.com" target="_blank">
                                <i class="text-secondary far fa-envelope me-3"></i> Adresse email
                            </a>
                        </p>
                        <p class="fs-5">
                            <a class="text-dark" href="https://goo.gl/maps/epAA1pitEZzXAoV9A" target="_blank">
                                <i class="fas fa-map-marker me-3 text-success"></i> Réalmont (81)
                            </a>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <span class="badge bg-secondary fs-6 mb-2">HTML</span>
                        <span class="badge bg-secondary fs-6 mb-2 mb-2">CSS</span>
                        <span class="badge bg-secondary fs-6 mb-2">Bootstrap</span>
                        <span class="badge bg-secondary fs-6 mb-2">Symfony</span>
                        <span class="badge bg-secondary fs-6 mb-2">Javascript</span>
                        <span class="badge bg-secondary fs-6 mb-2">Angular</span>
                        <span class="badge bg-secondary fs-6 mb-2">PHP</span>
                        <span class="badge bg-secondary fs-6  mb-2">MySQL</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div>
        <header class="mb-3 mb-md-4">
            <h2>Contact</h2>
        </header>

        <div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil magni neque itaque? Facilis in quaerat explicabo minima omnis!
                Et eveniet nihil suscipit adipisci quisquam eum nam unde obcaecati, ducimus voluptas?
            </p>
        </div>

        <div>
            <form method="POST" class="row mt-5">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label fw-bold mb-0">Nom</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="surname" class="form-label fw-bold mb-0">Prénom</label>
                    <input type="text" class="form-control" id="surname">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold mb-0">Adresse email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label fw-bold mb-0">Votre message</label>
                    <textarea class="form-control" id="message" rows="7"></textarea>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="text-uppercase btn btn-indigo">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</section>