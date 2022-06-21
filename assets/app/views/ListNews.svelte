<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';

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

    <Header title={$t('ListNews.Title')} subtitle={$t('ListNews.Subtitle')}/>

    <section class="contain-films">
        
        <ul class="grid-2">
        {#if news}
            {#each news as { id, title, text, creationdate, image}, i} 
                {#if i === 0}
                    <li class="news-emphase">
                        <img src="./uploads/posts/{image}" alt="article image" class="image">
                        <div class="home-news">
                            <p class="date">{creationdate}</p>
                            <p class="title">{title}</p>
                            <p>{text.substring(0,250)}</p>
                            <div class="btn btn-orange"><span class="text">{$t('News.External.Button')}</span></div>
                        </div>
                    </li> 
                {:else}
                    <li class="home-news">
                        <p class="date">{creationdate}</p>
                        <p class="title">{title}</p>
                        <p>{text.substring(0,250)}</p>
                        <div class="btn btn-orange"><span class="text">{$t('News.External.Button')}</span></div>
                    </li>
                {/if}
            {/each}
        {/if}
    </ul>
    </section>

    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('About.External.Title')}</h3>
            <div class="btn btn-orange"><span class="text">{$t('About.External.Button')}</span></div>
        </div>
    </section>

</main>

<Footer/>