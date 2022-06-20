<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import SocialMedia from '../components/SocialMedia.svelte'
</script>

<Nav/>

<main class="bg-texture">

    <Header title="Salle des talents" subtitle="B2Z Production"/>

    <section class="contain">
        <h3 class="title">Titre d'une partie</h3>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
    </section>

    <section class="form-script">
        <h3 class="title">Envoyez votre scénario</h3>
        <form method="POST" class="form-group">
            <div class="form-item">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" placeholder="Prénom*" required>
            </div>
            <div class="form-item">
                <label for="email">Nom</label>
                <input type="text" name="email" placeholder="Nom*" required>
            </div>
            <div class="form-item">
                <label for="mail">Email</label>
                <input type="mail" name="mail" placeholder="Email*">
            </div>
            <div class="form-item">
                <label for="phone">Email</label>
                <input type="tel" name="phone" placeholder="Téléphone">
            </div>
            <div class="form-item form-item--100">
                <label for="file">Ajouter votre scénario (pdf)</label>
                <input type="file" accept=".pdf" name="file" placeholder="Téléphone">
            </div>
            <div class="form-item form-item--100">
                <label for="pitch">Présentez votre scénario</label>
                <textarea name="pitch" cols="20" rows="10" placeholder="Pitchez votre projet en quelques phrases….*"></textarea>
            </div>
            <div class="form-item form-item--100">
                <label for="message">Message</label>
                <textarea name="message" cols="30" rows="10" placeholder="Quelques chose à ajouter..."></textarea>
            </div>
            <button type="submit" class="btn btn-orange">Envoyer le scénario</button>
        </form>
    </section>

   <SocialMedia/>

</main>