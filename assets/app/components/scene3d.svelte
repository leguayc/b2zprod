<script>
import * as THREE from 'three';
import { onMount } from 'svelte';
import { TextGeometry } from 'three/examples/jsm/geometries/TextGeometry.js';
import * as SceneHelper from "../helpers/Scene3DHelper.js";
import * as ModelHelper from "../helpers/Model3DHelper.js";
import { onDocumentMouseDown, cameraMoveReturn, cameraMoveCine, cameraMoveContact, setupNavigation, cameraMoveNews, cameraMoveAbout, cameraMoveTalent } from "../helpers/Navigation3DHelper.js";
import ThreeMeshUI from '../helpers/three-mesh-ui.js';
import FontJson from '../helpers/fonts/Roboto-msdf.json';
import FontImage from '../helpers/fonts/Roboto-msdf.png';

import { VRButton } from 'three/examples/jsm/webxr/VRButton.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { BoxLineGeometry } from 'three/examples/jsm/geometries/BoxLineGeometry.js';

import { fadeIn } from '../helpers/VisibilityHelper.js';
import axios from 'axios';
import { gsap } from "gsap";
import { getLocalization } from '../i18n';
const { t, currentLanguage } = getLocalization();

// Canvas
let canvas;
let projects = [];
let scene;
let popup;

const moveToCine = () => {
    cameraMoveCine();
    gsap.delayedCall(9.5, () => {
        setCarouselVisibility(true);
    })
}

const moveBackFromCine = () => {
    cameraMoveReturn();
    setCarouselVisibility(false);
}

onMount(() => {

    scene = SceneHelper.createSceneBase();

    scene.add(SceneHelper.overlayT.mesh)

    const sizes = SceneHelper.setResize();
    const camera = SceneHelper.addCamera(scene);
    SceneHelper.addLights(scene);

    function cameraMoveNewsT(){
        onclick="document.location.href='/news';'"
    }

    /**
     * Sizes of mobile screen
     */
    // Mobile orientation
    if( navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
        if (window.innerWidth < window.innerHeight){
            popup.style.display = 'flex';
            popup.style.zIndex = 99999;

            window.onclick = function(event) {
                popup.style.display = "none";
            } 
        } 
    }

    makeTextPanel({width: 5, height: 0.4}, {x: -4.77, y: -0.4, z:-1.64}, 1.53, 'Click on the posters to move through the rooms', 0.15 )
    makeTextPanel({width: 1, height: 2.2}, {x: -2.6, y: -2.5, z:-7.9}, 0, '1', 1 )
    makeTextPanel({width: 0.8, height: 0.2}, {x: -2.6, y: -1.6, z:-7.9}, 0, 'Salle', 0.2 )

    // Posters - Choix des salles 
    ModelHelper.createPoster(scene, '../posters/affiche.png', {x: -5.6, y: -2.08, z: 2.41}, 1.59, "posterAffiche", moveToCine);
    ModelHelper.createPoster(scene, '../posters/infos.png', {x: -5.6, y: -2.08, z: 0.11}, 1.59, "posterInfos", cameraMoveAbout);
    ModelHelper.createPoster(scene, '../posters/talents.png', {x: -5.6, y: -2.08, z: -2.16}, 1.59, "posterTalent", cameraMoveTalent);
    ModelHelper.createPoster(scene, '../posters/actus1.png', {x: -5.6, y: -2.08, z: -4.41}, 1.59, "posterActus", cameraMoveNews);
    ModelHelper.createPoster(scene, '../posters/contact.png', {x: -5.6, y: -2.08, z: -6.63}, 1.59, "posterContact", cameraMoveContact);

    // Posters equipe
    ModelHelper.createPoster(scene, '../posters/contactRoom/annie.jpg', {x: 13.2, y: -1.4, z: -5.74}, -1.575, "posterContact", null, {width: 1.18, height: 3.35});
    ModelHelper.createPoster(scene, '../posters/contactRoom/hakim.png', {x: 13.2, y: -1.96, z: -1.96}, -1.575, "posterContact", null, {width: 1.18, height: 3.2});
    ModelHelper.createPoster(scene, '../posters/contactRoom/gaetan.png', {x: 13.2, y: -0.04, z: -4.05}, -1.575, "posterContact", null, {width: 1.18, height: 3.35});
    const poster3 = ModelHelper.createPoster(scene, '../posters/contactRoom/walid.png', {x: 13.2, y: -0.26, z: -2.28}, -1.58, "posterContact", null, {width: 1.6, height: 2.3});
    const grandPoster = ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: 11.5, y: -1.3, z: -6.9}, 0, "posterContact", null, {width: 1.93, height: 5.32});
    const grandPosterEntree = ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: 4.8, y: -1.64, z: -7.95}, 0, "posterContact", null, {width: 1.38, height: 3.8});
    const posterTalent = ModelHelper.createPoster(scene, '../posters/affiche.png', {x: 13.2, y: -1.9, z: -3.78}, -1.58, "posterContact", null, {width: 1.18, height: 3.35});
    const poster4 = ModelHelper.createPoster(scene, '../posters/affiche.png', {x: 13.2, y: -1.25, z: -0.25}, -1.58, "posterContact", null, {width: 1.18, height: 3.35});

    // Posters front wall entrance
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: 5.15, y: -2.34, z: 4.45}, 0.1, "posterContact", null, {width: 1.38, height: 3.8});
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: 9.25, y: -2.33, z: 4.3}, 0, "posterContact", null, {width: 1.38, height: 3.85});
    const grandPosterEntree2 = ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: -9.02, y: -2.34, z: 4.2}, 0, "posterContact", null, {width: 1.38, height: 3.85});
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: -5.14, y: -2.33, z: 4.45}, -0.07, "posterContact", null, {width: 1.38, height: 3.85});
    
    // poster3.rotation.x = 1.58
    poster4.rotation.x = 1.58
    posterTalent.rotation.x = 1.58;

    /**
     * Click function
     */
    window.addEventListener('click', onDocumentMouseDown, false);

    // Return buttons 
    const returnButton1 = ModelHelper.createButton(scene, "../assets/images/cinema.png", 0, {x: 0, y: -2.4, z: 26.5}, "enterMenu", cameraMoveReturn, {width: 0.68, height: 2.85});
    ModelHelper.createButton(scene, "../assets/images/menu.png", 0, {x: -2.7, y: -0.5, z: -12.5}, "return", moveBackFromCine, {width: 0.68, height: 2.85});
    ModelHelper.createButton(scene, "../assets/images/menu.png", -1.5, {x: 11.1, y: -0.07, z: -5.55}, "return1", cameraMoveReturn, {width: 0.68, height: 2.85});

    /**
     * Movie screen (test with local video)
     */
    // const video = document.getElementById('iframe-4');
    // const videoTexture = new THREE.VideoTexture(video);
    // const videoMaterial =  new THREE.MeshBasicMaterial( {map: videoTexture, side: THREE.FrontSide, toneMapped: false} );

    // const screen = new THREE.PlaneGeometry(10.1, 14.05*0.51);
    // const videoScreen = new THREE.Mesh(screen, videoMaterial);
    // video.play()

    // videoScreen.position.set(0, -2.6, -22)
    // videoScreen.name = "movieScreen"

    // scene.add(videoScreen);

    /**
     * Text 
     */
    SceneHelper.fontLoader.load('../fonts/helvetiker_regular.typeface.json', (font) => {
        const textGeometry = new TextGeometry('B2Z Production',
            {
                font: font,
                size: 0.7,
                height: 0.2,
                curveSegments: 12,
                bevelEnabled: true,
                bevelThickness: 0.03,
                bevelSize: 0.02,
                bevelOffset: 0,
                bevelSegments: 5
            }
        );
        
        const matcapTexture = new THREE.MeshPhongMaterial( { color: 0xffffff, flatShading: true } )
        const textMaterial = new THREE.MeshMatcapMaterial({matcap : matcapTexture})
        const text = new THREE.Mesh(textGeometry, textMaterial)

        scene.add(text)

        // test disposition1 
        text.position.set(-3.2, 1.55, 7.75)

    });

    /**
     * Controls
     */
    const controls = SceneHelper.createControls(canvas);

    /**
     * Text onn 3D scene
     */
    function makeTextPanel(size = {width: 5, height: 0.4}, position, rotationY, text, fontSize ) {
        const container = new ThreeMeshUI.Block( {
            width: size.width,
            height: size.height,
            padding: 0.05,
            justifyContent: 'center',
            textAlign: 'left',
            fontFamily: FontJson,
            fontTexture: FontImage
        } );
        container.position.set(position.x, position.y, position.z);
        container.rotation.y = rotationY;
        scene.add( container );

        // const cubeTestRotation = SceneHelper.gui.addFolder('poster3 ')
        // cubeTestRotation.add(container.position, 'x').min(-60).max(60).step(0.01).name('position X')
        // cubeTestRotation.add(container.position, 'y').min(-60).max(60).step(0.01).name('position Y')
        // cubeTestRotation.add(container.position, 'z').min(-60).max(60).step(0.01).name('position Z')
        // cubeTestRotation.add(container.rotation, 'x').min(-60).max(60).step(0.01).name('rotation X')
        // cubeTestRotation.add(container.rotation, 'y').min(-60).max(60).step(0.01).name('rotation Y')
        // cubeTestRotation.add(container.rotation, 'z').min(-60).max(60).step(0.01).name('rotation Z')

        container.add(
            new ThreeMeshUI.Text( {
                content: text,
                fontSize: fontSize
            }),
        );
    }

    /**
     * Renderer
     */
    const renderer = SceneHelper.createRenderer(canvas, sizes);
    
    setupNavigation(scene, renderer, camera, controls);

    const urlParams = new URLSearchParams(window.location.search);
    const route = urlParams.get('r');
    
    switch (route) {
        case 'menu':
            camera.position.set(1.2, -1.5, -1.8);
            controls.target.set(-12, -2, -2);
            break;
        case 'projects':
            camera.position.set(0, -1.5, -7.85);
            controls.target.set(0.71, -3.2, -29.02);
            setCarouselVisibility(true);
            break;
        case 'trophy':
            camera.position.set(5.4, -2, -3.2);
            controls.target.set(8.5, -2, -3.2);
            break;
        default:
    }

    /**
     * Animate
     */
    const clock = new THREE.Clock();

    const tick = () =>
    {
        const elapsedTime = clock.getElapsedTime();

        ThreeMeshUI.update()

        // Update controls
        controls.update();

        // Render
        renderer.render(scene, camera);

        // Call tick again on the next frame
        window.requestAnimationFrame(tick);
    };

    tick();

    axios.get('/api/projects').then( (response) => {
        for(let i = 0; i < response.data['hydra:member'].length; i++) {
            projects[i] = response.data['hydra:member'][i];
            
            if(projects[i].trailer.includes('watch')) {
                projects[i].trailer = "https://www.youtube.com/embed/" + projects[i].trailer.split("?v=")[1].split('&')[0];
            }
        }
    }).catch((error) => {
        console.log("error");
    });
});

let carousel;
let selectedCarouselItem = 0;

const getCurrentTrad = (translations, propertyName) => {
    return translations[$currentLanguage] ? translations[$currentLanguage][propertyName] : translations['fr'][propertyName]
}

const carouselNextItem = () => {
    selectedCarouselItem = selectedCarouselItem + 1 < projects.length ? selectedCarouselItem + 1 : 0;
}

const carouselPreviousItem = () => {
    selectedCarouselItem = selectedCarouselItem - 1 >= 0 ? selectedCarouselItem - 1 : projects.length - 1;
}

const setCarouselVisibility = (willBeShown) => {
    if (willBeShown) {
        fadeIn(carousel, 400);
    } else {
        carousel.style.display = 'none';
    }
}

</script>
<style>
    .webgl{
        position: fixed;
        top: 0;
        left: 0;
        outline: none; 
    }

    .modal{
        background-color: #00000077;
        color: #fff;
        margin: 5em 3em 0 3em;
        z-index: 9999;
        padding: 30px;
        font-size: x-large;
        text-align: justify;
        display: none;
    }


</style>

<div bind:this={popup}>
    <p class="modal">Pour profiter pleinement de notre site merci de tourner votre mobile en mode paysage</p>
</div>
<video id="video" playsinline webkit-playsinline muted loop autoplay width="2000" height="500"src="../posters/testFilm/test.mov" style="display: none;"></video>
<canvas bind:this={canvas} class="webgl" style="z-index: -1"></canvas>

<div class="projects-carousel" bind:this={carousel} style="display: none">
{#each projects as project, i}
    <div class="project-item {i == selectedCarouselItem ? "selected" : ""}" bind:this={project.element}>
        <div class="contain-iframe">
            {#if i == selectedCarouselItem}
            <iframe title="Youtube Movie {project.id}" src="{project.trailer}?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            {/if}
        </div>
        <div class="content">
            <h2>{getCurrentTrad(project.translations, 'title')}</h2>
            <p>{$t('Project.Producer')} {project.filmmakerFullName}</p>
            <a href="/project/{project.id}" class="btn btn-orange">{$t('Project.External.Button')}</a>
        </div>
    </div>
{/each}
    <div class="image prev" on:click={carouselPreviousItem}><img src="/assets/images/popcorn_prev.png" alt="Prev"/></div>
    <div class="image next" on:click={carouselNextItem}><img src="/assets/images/popcorn_next.png" alt="Next"/></div>
</div>