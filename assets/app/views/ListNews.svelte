<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';
    import {gsapInit} from '../helpers/GsapHelper.js';

    import axios from 'axios';
    import { onMount } from 'svelte';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let news, i18n;

    onMount(async () => {
        axios.get('/api/blog_posts/').then( (response) => {
            news = [];
            let data = response.data['hydra:member'];

            for(let i = 0; i < data.length; i++) {
                if (data[i].locale == $currentLanguage) {
                    news.push(data[i]);
                }
            }
        }).catch((error) => {
            console.log("error");
        });
    });

</script>


<Nav/>

<main class="bg-texture">

    <Header title={$t('ListNews.Title')} subtitle={$t('ListNews.Subtitle')} image="../assets/images/ticket.png"/>

    <section class="contain-films">
        
        <ul class="grid-2">
        {#if news}
            {#each news as { id, title, text, creationdate, image}, i} 
                {#if i === 0}
                    <li class="news-emphase gs_reveal gs_reveal_fromRight">
                        <img src="./uploads/posts/{image}" alt="article" class="image" />
                        <div class="home-news">
                            <p class="date">{creationdate.split('T')[0]}</p>
                            <p class="title">{title}</p>
                            <p>{text.substring(0,250)}</p>
                            <a href="/news/{id}" class="btn btn-orange"><span class="text">{$t('News.External.Button')}</span></a>
                        </div>
                    </li> 
                {:else}
                    <li class="home-news gs_reveal gs_reveal_fromBottom">
                        <p class="date">{creationdate.split('T')[0]}</p>
                        <p class="title">{title}</p>
                        <p>{text.substring(0,250)}</p>
                        <a href="/news/{id}" class="btn btn-orange"><span class="text">{$t('News.External.Button')}</span></a>
                    </li>
                {/if}
            {/each}
        {/if}
    </ul>
    </section>


    <section class="bg-movie">
        <div class="bg-pelicule gs_pelicule">
            <img src="/assets/images/pelicule.png" alt="pelicule">
        </div>
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('About.External.Title')}</h3>
            <a href="/about" class="btn btn-orange"><span class="text">{$t('About.External.Button')}</span></a>
        </div>
    </section>

</main>

<Footer/>