<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';
    import {gsapInit} from '../helpers/GsapHelper.js';

    import axios from 'axios';
    import { onMount } from 'svelte';

    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let news = {
        title : "",
        text : "",
        creationdate: null,
        image : null,
    };

    export let id;
    
    let otherNews = [];
    let googleForm;

    let resizeIframe = () =>{
        if(googleForm) resizeIFrameToFitContent( googleForm );
    }
        
    onMount(async () => {
        axios.get('/api/blog_posts/' + id).then( (response) => {
            news = response.data;
            news.creationdate = news.creationdate.split('T')[0];

            console.log(news);
        }).catch((error) => {
            console.log("error");
        });
        
        axios.get('/api/blog_posts').then( (response) => {
            otherNews = response.data['hydra:member'];
        }).catch((error) => {
            console.log("error");
        });

        gsapInit();
    });

   
</script>

<Nav/>

<main class="bg-texture">

    <Header title="{news.title}" subtitle="{news.creationdate}" image="../assets/images/popcorn.png"/>

    <section class="contain-article gs_reveal gs_reveal_fromRight">
        <h2 class="title">{news.title}</h2>
        <p class="text">{news.text}</p>
        <img src="/uploads/posts/{news.image}" alt="article" class="image" />

        {#if news.formLink}
            <div class="googleform-container">
                <iframe title="Google Form" src={news.formLink}></iframe>
            </div>
        {/if}
    </section>


    <section class="bg-movie">
        <div class="bg-pelicule gs_pelicule">
            <img src="/assets/images/pelicule.png" alt="pelicule">
        </div>
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Project.External.Title')}</h3>
            <a href="/?r=projects" class="btn btn-orange"><span class="text">{$t('Project.External.Button')}</span></a>
        </div>
    </section>


    {#if otherNews[0]}
    <section class="contain-films gs_reveal gs_reveal_fromRight">
        <h2 class="title">{$t('News.More.Title')}</h2>
        <ul class="grid-2">
            {#each otherNews as {id, creationdate, title, text}}
            <li class="home-news gs_reveal gs_reveal_fromBottom">
                <div>
                    <p class="date">{creationdate.split('T')[0]}</p>
                    <p class="title">{title}</p>
                    <p>{text.substring(0,250)}..</p>
                </div>
                <a href="/news/{id}" class="btn btn-orange"><span class="text">{$t('Project.External.Button.Title')}</span></a>
            </li>
            {/each}
        </ul>
    </section>
    {/if}

</main>

<Footer/>