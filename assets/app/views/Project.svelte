<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';
    
    //import { gsap } from "gsap";
    //import { ScrollTrigger } from "gsap/ScrollTrigger";
    //import { ScrollSmoother } from "gsap/ScrollSmoother";

    import axios from 'axios';
    import { onMount } from 'svelte';

    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();
    let projects = { };

    let otherProjects = [];

    export let id;

    onMount(async () => {
        axios.get('/api/projects/' + id).then( (response) => {
            projects = response.data;

            let translation = response.data.translations[$currentLanguage] ? response.data.translations[$currentLanguage] : response.data.translations['fr'];
            translateProject(translation);

            if(projects.trailer.includes('watch')) {
                projects.trailer = "https://www.youtube.com/embed/" + projects.trailer.split("?v=")[1].split('&')[0];
            }

            projects.date = projects.date.split('T')[0];
        }).catch((error) => {
            console.log("error");
        });
        
        axios.get('/api/projects').then( (response) => {
            for(let i = 0; i < 3; i++) {
                otherProjects[i] = response.data['hydra:member'][i];
            }
        }).catch((error) => {
            console.log("error");
        });

        currentLanguage.subscribe((lang) => {
            if (projects.translations) {
                let translation = projects.translations[lang] ? projects.translations[lang] : projects.translations['fr'];
                translateProject(translation);
            }
        });
    });


    const translateProject = (translation) => {
        projects.title = translation.title;
        projects.text = translation.description;
        projects.section1Text = translation.section1Text;
        projects.section1Title = translation.section1Title;
        projects.section2Text = translation.section2Text;
        projects.section2Title = translation.section2Title;
    }

    const getCurrentTrad = (translations, propertyName) => {
        return translations[$currentLanguage] ? translations[$currentLanguage][propertyName] : translations['fr'][propertyName]
    }

</script>

<Nav/>

<main class="bg-texture">

    <section class="contain-video">
        <iframe class="video" width="560" height="315" src={projects.trailer} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>

    <Header title={projects.title} subtitle="{projects.date} - {$t('Project.Producer')} {projects.filmmakerFullName}"/>

    <section class="contain-emphase">
        <img class="image" src="/uploads/projects/{projects.image}" alt="a fleur de peau">
        <div class="content bg-black">
            <div>
                {#if projects.section1Title && projects.section1Text}
                <p class="title">{projects.section1Title}</p>
                <ul>
                    {#each projects.section1Text.split("\n") as text}
                    <li>{text}</li>
                    {/each}
                </ul>
                {/if}
                {#if projects.section2Title && projects.section2Text}
                <p class="title">{projects.section2Title}</p>
                <ul>
                    {#each projects.section2Text.split("\n") as text}
                    <li>{text}</li>
                    {/each}
                </ul>
                {/if}
            </div>
            <div class="btn btn-orange"><span class="text">{$t('Presse.Title')}</span></div>
        </div>
    </section>

    <section class="contain">
        <div class="contain-text">
             <h3 class="title">{projects.title}</h3>
             <p class="text">{projects.description}</p>        
        </div>
     </section>
  
    <section class="bg-movie">
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Project.Distributor.Title')}</h3>
            <div class="btn btn-orange"><a href={projects.distributorLink}><span class="text">{$t('Project.Distributor.Text')}</span></a></div>
        </div>
    </section>

    {#if projects.projectThanks && projects.projectThanks.length > 0}
    <section class="contain-partners">

        <h2 class="title">{$t('Project.Thanks')} :</h2>

        <ul class="partners">
            {#each projects.projectThanks as {name}}
            <li>{name}</li>
            {/each}
        </ul>
    </section>
    {/if}

    <section class="contain">
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Contact.External.Title')}</h3>
            <a href="mailto:test@gmail.com" class="btn btn-orange"><span class="text">{$t('Contact.External.Text')}</span></a>
        </div>
    </section>

    <section class="contain-films">
        <h2 class="title">{$t('Project.OtherMovies')} :</h2>
        <ul class="grid-3">
            {#each otherProjects as {id, image, translations}}
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="/uploads/projects/{image}" alt="{getCurrentTrad(translations, 'title')}">
                </div>
                <div class="content">
                    <span class="text">{getCurrentTrad(translations, 'title')}</span>
                    <a href="/project/{id}" class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </a>
                </div>
            </li>
            {/each}
        </ul>
    </section>


</main>

<Footer/>
