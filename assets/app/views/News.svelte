<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
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

    });

</script>

<Nav/>

<main class="bg-texture">

    <Header title="{news.title}" subtitle="{news.creationdate}"/>

    <section class="contain-article">
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
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Project.External.Title')}</h3>
            <a href="/" class="btn btn-orange"><span class="text">{$t('Project.External.Button')}</span></a>
        </div>
    </section>


    {#if otherNews[0]}
    <section class="contain-films">
        <h2 class="title">{$t('News.More.Title')}</h2>
        <ul class="grid-2">
            {#each otherNews as {id, creationdate, title, text}}
            <li class="home-news">
                <p class="date">{creationdate.split('T')[0]}</p>
                <p class="title">{title}</p>
                <p>{text.substring(0,250)}..</p>
                <a href="/news/{id}" class="btn btn-orange"><span class="text">{$t('Project.External.Button.Title')}</span></a>
            </li>
            {/each}
        </ul>
    </section>
    {/if}


</main>