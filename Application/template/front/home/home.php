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
            <form method="POST" action="/" class="row mt-5">
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
    </div>
</section>