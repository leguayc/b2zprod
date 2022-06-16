<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import axios from 'axios';
    import { onMount } from 'svelte';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let news = {
        title : "",
        image : "",
        text: "",
        creationdate : null,
    }

    let otherNews;

    onMount(async () => {
        axios.get('/api/blog_posts/1').then( (response) => {
            news = response.data;
        }).catch((error) => {
            console.log("error");
        });

        axios.get('/api/blog_posts').then( (response) => {
            otherNews = response.data;
            otherNews.slice(0,2);
            console.log(otherNews);
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
            <img src="./uploads/posts/{news.image}" alt="image article" class="image">
    </section>

    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Project.External.Title')}</h3>
            <div class="btn btn-orange"><span class="text">{$t('Project.External.Button')}</span></div>
        </div>
    </section>


    {#if otherNews}
    <section class="contain-films">
        <h2 class="title">{$t('News.More.Title')}</h2>
        <ul class="grid-2">
            {#each otherNews as {creationdate, title, text}}
            <li class="home-news">
                <p class="date">{creationdate}</p>
                <p class="title">{title}</p>
                <p>{text}</p>
                <div class="btn btn-orange"><span class="text">{$t('Project.External.Button.Title')}</span></div>
            </li>
            {/each}
        </ul>
    </section>
    {/if}


</main>