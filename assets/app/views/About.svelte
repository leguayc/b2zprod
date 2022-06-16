<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
</script>

<Nav/>

<main class="bg-texture">

    <Header title="Salle des infos" subtitle="B2Z Production"/>

    <section class="about-emphase">
        <div class="contain-image">
            <img class="image" src="./assets/images/icon-b2z.svg" alt="logo">
            <img class="image" src="./assets/images/text-b2z.svg" alt="logo">
        </div>
        
        <div class="content bg-black">
            <div>
                <h3 class="title">Qui sommes-nous ?</h3>
                <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates repellendus ipsam minima quo ea sint corporis itaque esse, provident beatae?</p>
            </div>
            <div class="btn btn-orange"><span class="text">Voir nos films</span></div>
        </div>
    </section>

    <section class="about-people">

      <ul class="about-nav">
        <li class="active"><img src="./assets/images/avatar.png" alt=""></li>
        <li><img src="./assets/images/avatar.png" alt=""></li>
        <li><img src="./assets/images/avatar.png" alt=""></li>
        <li><img src="./assets/images/avatar.png" alt=""></li>
        <li><img src="./assets/images/avatar.png" alt=""></li>
        <li><img src="./assets/images/avatar.png" alt=""></li>
      </ul>

      <div class="content">
        <img src="./assets/images/model3d.png" alt="">
        <div class="info">
            <h3 class="title">Nom prenom</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam dignissimos dolor officiis in iure libero nam ab omnis earum commodi.</p> 
            <div class="btn btn-orange"><span class="text">En savoir plus</span></div>
        </div>
      </div>

    </section>

    <section class="about-partners">
        <h2 class="title">Nos partenaires :</h2>
        <ul class="grid-4">
            <li><img src="./assets/images/paris.png" alt="paris"></li>
            <li><img src="./assets/images/cnc.png" alt="paris"></li>
            <li><img src="./assets/images/paris.png" alt="paris"></li>
            <li><img src="./assets/images/tryptik.png" alt="paris"></li>
            <li><img src="./assets/images/paris.png" alt="paris"></li>
            <li><img src="./assets/images/cnc.png" alt="paris"></li>
            <li><img src="./assets/images/paris.png" alt="paris"></li>
            <li><img src="./assets/images/tryptik.png" alt="paris"></li>
        </ul>
    </section>

    <section class="contain">
        <h2 class="title">Catalogue</h2>
        <ul class="grid-3">
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li> <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li> <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content content-center">
                    <span class="text">A fleur de peau</span>
                    <div class="btn btn-orange"><span class="text">Dossier de press</span></div>
                </div>
            </li>
        </ul>
    </section>


</main>