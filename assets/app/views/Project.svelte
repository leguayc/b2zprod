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

    currentLanguage.update(current => current === 'en' ? 'en' : 'fr')

    let projects = {};

    let otherProjects = [];


    onMount(async () => {
        axios.get('/api/projects/1').then( (response) => {
            projects = response.data;

            let link;

            if($currentLanguage === 'fr'){
                link = response.data.translations.fr;
            }else{
                link = response.data.translations.en;
            }

            projects.title = link.title;
            projects.text = link.description;
            projects.section1Text = link.section1Text;
            projects.section1Title = link.section1Title;
            projects.section2Text = link.section2Text;
            projects.section2Title = link.section2Title;


        }).catch((error) => {
            console.log("error");
        });
        
        axios.get('/api/projects').then( (response) => {
            otherProjects = response.data['hydra:member'];
            console.log('otherProjects', otherProjects);
        }).catch((error) => {
            console.log("error");
        });

    });

    /*gsap.registerPlugin(ScrollTrigger);

    function animateFrom(elem, direction) {
        direction = direction || 1;
        var x = 0,
            y = direction * 100;
        if(elem.classList.contains("gs_reveal_fromLeft")) {
            x = -100;
            y = 0;
        } else if (elem.classList.contains("gs_reveal_fromRight")) {
            x = 100;
            y = 0;
        }
        elem.style.transform = "translate(" + x + "px, " + y + "px)";
        elem.style.opacity = "0";
        gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
            duration: 1.25, 
            x: 0,
            y: 0, 
            autoAlpha: 1, 
            ease: "expo", 
            overwrite: "auto"
        });
    }

function hide(elem) {
  gsap.set(elem, {autoAlpha: 0});
}

document.addEventListener("DOMContentLoaded", function() {
  gsap.registerPlugin(ScrollTrigger);
  
  gsap.utils.toArray(".gs_reveal").forEach(function(elem) {
    hide(elem); // assure that the element is hidden when scrolled into view
    
    ScrollTrigger.create({
      trigger: elem,
      onEnter: function() { animateFrom(elem) }, 
      onEnterBack: function() { animateFrom(elem, -1) },
      onLeave: function() { hide(elem) } // assure that the element is hidden when scrolled into view
    });
  });
});*/

    
    


</script>

<Nav/>

<main class="bg-texture">

    <section class="contain-video">
        <iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/LXb3EKWsInQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>

    <Header title="Nom du projet" subtitle="11/06/2021 - {$t('Project.Producer')} Jordan Anefalos"/>

    <section class="contain-emphase">
        <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
        <div class="content bg-black">
            <div>
                <p class="title">{$t('Project.Script.Title')}</p>
                <ul>
                    <li>Walid Ben Mabrouk</li>
                    <li>Hakim Soudjay</li>
                </ul>
                <p class="title">{$t('Project.Casting.Title')}</p>
                <ul>
                    <li>Jordan Anefalos</li>
                    <li>Baya Belal</li>
                    <li>Walid Ben Mabrouk</li>
                    <li>Liliane Rovère</li>
                </ul>
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
            <div class="btn btn-orange"><span class="text">{$t('Project.Distributor.Text')}</span></div>
        </div>
    </section>

    <section class="contain-partners">
        <h2 class="title">Les partenaires et remerciements :</h2>
        <ul class="partners">
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
            <li>entreprise</li>
            <li>nom prénom</li>
        </ul>
    </section>

    <section class="contain">
        <div class="contain-xs bg-black">
            <h3 class="title">{$t('Contact.External.Title')}</h3>
            <a href="mailto:test@gmail.com" class="btn btn-orange"><span class="text">{$t('Contact.External.Text')}</span></a>
        </div>
    </section>

    <section class="contain-films">
        <h2 class="title">Découvrir d'autres réalisations :</h2>
        <ul class="grid-3">
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </li>
            <li class="home-film">
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </li>
            <li class="home-film" >
                <div class="image-contain">
                    <img class="image" src="./assets/images/a_fleur_de_peau.png" alt="a fleur de peau">
                </div>
                <div class="content">
                    <span class="text">A fleur de peau</span>
                    <div class="btn-xs btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="icon">
                            <path id="add2" d="M11,4.976H6.024V0H4.976V4.976H0V6.024H4.976V11H6.024V6.024H11Z" transform="translate(0.5 0.5)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
                <button>Ouvrir</button>
            </li>
        </ul>
    </section>


</main>

<Footer/>
