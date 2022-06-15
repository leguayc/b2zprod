<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
</script>

<Nav/>

<main class="bg-texture">

    <Header title="Titre de l'actualité" subtitle="11/06/2022"/>

    <section class="contain-article">
            <h2 class="title">Titre d'une partie</h2>
            <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <img src="./assets/images/news.png" alt="image article" class="image">
    </section>

    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">Voir les films à l'affiche</h3>
            <div class="btn btn-orange"><span class="text">En savoir plus</span></div>
        </div>
    </section>


    <section class="contain-films">
        <h2 class="title">Découvrir d'autres actualités :</h2>
        <ul class="grid-2">
            <li class="home-news">
                <p class="date">11/06/2022</p>
                <p class="title">Titre de l'actualité</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ull</p>
                <div class="btn btn-orange"><span class="text">Lire la suite</span></div>
            </li>
            <li class="home-news">
                <p class="date">11/06/2022</p>
                <p class="title">Titre de l'actualité</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ull</p>
                <div class="btn btn-orange"><span class="text">Lire la suite</span></div>
            </li>
        </ul>
    </section>


</main>