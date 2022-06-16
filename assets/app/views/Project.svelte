<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
</script>

<Nav/>

<main class="bg-texture">

    <section class="contain-video">
        <iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/LXb3EKWsInQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>

    <Header title="Nom du projet" subtitle="11/06/2021 - réalisé par Jordan Anefalos"/>

    <section class="contain-emphase">
        <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
        <div class="content bg-black">
            <div>
                <p class="title">scénario</p>
                <ul>
                    <li>Walid Ben Mabrouk</li>
                    <li>Hakim Soudjay</li>
                </ul>
                <p class="title">casting</p>
                <ul>
                    <li>Jordan Anefalos</li>
                    <li>Baya Belal</li>
                    <li>Walid Ben Mabrouk</li>
                    <li>Liliane Rovère</li>
                </ul>
            </div>
            <div class="btn btn-orange"><span class="text">Dossier presse</span></div>
        </div>
        
    </section>

    <section class="contain">
       <div class="contain-text">
            <h3 class="title">Titre d'une partie</h3>
            <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
       </div>
    </section>

    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">Où trouver le film ?</h3>
            <div class="btn btn-orange"><span class="text">Le distributeur</span></div>
        </div>
    </section>

    <section class="contain-partners">
        <h2 class="title">Les partenaires et remerciement :</h2>
        <ul class="partners">
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
        </ul>
    </section>

    <section class="contain">
        <div class="contain-xs bg-black">
            <h3 class="title">Vous souhaitez plus d'informations ?</h3>
            <a href="mailto:test@gmail.com" class="btn btn-orange"><span class="text">Contactez-nous</span></a>
        </div>
    </section>

    <section class="contain-films">
        <h2 class="title">Découvrir d'autres réalisations :</h2>
        <ul class="grid-3">
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </li>
        </ul>
    </section>


</main>