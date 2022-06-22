<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';

    import {gsapInit} from '../helpers/GsapHelper.js';

    import axios from 'axios';
    import { onMount } from 'svelte';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let projects = {
        title : "Nom du film"
    }

    let partners = [];

    let peopleShow = 0;

    onMount(async () => {

        axios.get('/api/projects').then( (response) => {
            projects = response.data['hydra:member'];
            console.log("projects", projects);
        }).catch((error) => {
            console.log("error");
        });

        axios.get('/api/partners').then( (response) => {
            partners = response.data['hydra:member'];
            console.log("parters", partners)
        }).catch((error) => {
            console.log("error");
        });

        gsapInit();    

    });


</script>
<Nav/>

<main class="bg-texture">

    <Header title="{$t('About.Title')}" subtitle=""/>

    <section class="about-emphase gs_reveal gs_reveal_fromRight">
        <div class="contain-image">
            <img class="image" src="./assets/images/icon-b2z.svg" alt="logo">
            <img class="image" src="./assets/images/text-b2z.svg" alt="logo">
        </div>
        
        <div class="content bg-black">
            <div>
                <h3 class="title">{$t('About.Content.Title')}</h3>
                <p class="text">{$t('About.Content.Text')}</p>
            </div>
            <a href="/?r=projects" class="btn btn-orange"><span class="text">{$t('About.Content.Button')}</span></a>
        </div>
    </section>

    <section class="about-people">

        <ul class="about-nav">
          <li 
              class="{peopleShow === 0 ? 'active' : ''}"
              on:click={ () => {peopleShow = 0; }} >
              <img src="/assets/images/gaetan.png" alt="geatan">
          </li>
          <li 
              class="{peopleShow === 1 ? 'active' : ''}"
              on:click={ () => {peopleShow = 1 }}>
              <img src="/assets/images/annie.jpg" alt="annie">
          </li>
          <li 
              class="{peopleShow === 2 ? 'active' : ''}"
              on:click={ () => {peopleShow = 2; }}>
              <img src="/assets/images/hakim.png" alt="hakim">
          </li>
          <li     
              class="{peopleShow === 3 ? 'active' : ''}"
              on:click={ () => {peopleShow = 3; }}>
              <img src="/assets/images/walid.png" alt="walid">
          </li>
        </ul>
  
        <div class="content">
          {#if peopleShow === 0 }
          <div class="presentation gs_reveal_fromBottom gs_reveal">
              <img src="/assets/images/gaetan.png" alt="">
              <div class="info">
                  <h3 class="title">gaetan</h3>
                  <p>{$t('About.Gaetan')}</p> 
                  <div class="btn btn-orange"><span class="text">{$t('About.Presentation.Button')}</span></div>
              </div>
          </div>
          {/if}
          {#if peopleShow ===  1 }
          <div class="presentation gs_reveal_fromBottom gs_reveal">
              <img src="/assets/images/annie.jpg" alt="">
              <div class="info">
                  <h3 class="title">Annie</h3>
                  <p>{$t('About.Annie')}</p> 
                  <div class="btn btn-orange"><span class="text">{$t('About.Presentation.Button')}</span></div>
              </div>
          </div>
          {/if}
          {#if peopleShow ===  2}
          <div class="presentation gs_reveal_fromBottom gs_reveal">
              <img src="/assets/images/hakim.png" alt="">
              <div class="info">
                  <h3 class="title">Hakim</h3>
                  <p>{$t('About.Hakim')}</p>
                  <div class="btn btn-orange"><span class="text">{$t('About.Presentation.Button')}</span></div>
              </div>
          </div>
          {/if}
          {#if peopleShow === 3 }
          <div class="presentation gs_reveal_fromBottom gs_reveal">
              <img src="/assets/images/walid.png" alt="">
              <div class="info">
                  <h3 class="title">Walid</h3>
                  <p>{$t('About.Walid')}</p>
                  <div class="btn btn-orange"><span class="text">{$t('About.Presentation.Button')}</span></div>
              </div>
          </div>
          {/if}
        </div>
      </section>
  

    {#if partners[0]}
    <section class="about-partners gs_reveal gs_reveal_fromRight">
        <h2 class="title">{$t('Partners.Title')}</h2>
        <ul class="grid-4">
            {#each partners as {image, name}}
                <li>
                    {#if image}
                    <img src="/uploads/partners/{image}" alt="{name}">
                    {:else}
                        <h3>{name}</h3>
                    {/if}
                </li>
            {/each}
        </ul>
    </section>
    {/if }

    {#if projects[0]}
    <section class="contain gs_reveal gs_reveal_fromLeft">
        <h2 class="title">{$t('Presse.Title')}</h2>
        <ul class="grid-3">
            {#each projects as {title, pressKit, image, id}}
            <li class="home-film">
                <div class="image-contain">
                    {#if image}<img class="image" src="/uploads/projects/{image}" alt="{title}">{/if}
                </div>
                <div class="content content-center">
                    <span class="text">{title}</span>
                    <a href="/uploads/projects/{pressKit}" target="_blank" class="btn btn-orange"><span class="text">{$t('Presse.Button')}</span></a>
                </div>
            </li>
            {/each}
        </ul>
    </section>
    {/if }


</main>

<Footer/>