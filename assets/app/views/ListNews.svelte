<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from "../components/Footer.svelte";

    import axios from 'axios';
    import { onMount } from 'svelte';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let news, i18n;

    onMount(async () => {
        axios.get('/api/blog_posts/').then( (response) => {
            news = response.data['hydra:member'];
        }).catch((error) => {
            console.log("error");
        });
    });

</script>

<Nav/>

<main class="bg-texture">

    <Header title="Salle des actualités" subtitle="B2Z Production"/>

    <section class="contain-films">
        <div class="news-emphase">
            <img src="./assets/images/news.png" alt="article image" class="image">
            <div class="home-news">
                <p class="date">11/06/2022</p>
                <p class="title">Titre de l'actualité</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ull</p>
                <div class="btn btn-orange"><span class="text">Lire la suite</span></div>
            </div>
        </div>
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

    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">Qui sont B2Z Production</h3>
            <div class="btn btn-orange"><span class="text">En savoir plus</span></div>
        </div>
    </section>

</main>

<Footer/>