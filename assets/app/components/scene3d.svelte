<script>
import * as THREE from 'three';
import { onMount } from 'svelte';
import { TextGeometry } from 'three/examples/jsm/geometries/TextGeometry.js';
import * as SceneHelper from "../helpers/Scene3DHelper.js";
import * as ModelHelper from "../helpers/Model3DHelper.js";
import { onDocumentMouseDown, cameraMoveReturn, cameraMoveCine, cameraMoveContact, setupNavigation } from "../helpers/Navigation3DHelper.js";
// import { log } from 'console';

// Canvas
let canvas;

onMount(() => {

    const scene = SceneHelper.createSceneBase();

    scene.add(SceneHelper.overlayT.mesh)

    const sizes = SceneHelper.setResize();
    const camera = SceneHelper.addCamera(scene);
    SceneHelper.addLights(scene);

    ModelHelper.createPoster(scene, '../posters/affiche.png', {x: -5.6, y: -2.08, z: 2.41}, 1.59, "posterAffiche", cameraMoveCine);
    ModelHelper.createPoster(scene, '../posters/infos.png', {x: -5.6, y: -2.08, z: 0.11}, 1.59, "posterInfos", cameraMoveCine);
    ModelHelper.createPoster(scene, '../posters/talents.png', {x: -5.6, y: -2.08, z: -2.16}, 1.59, "posterTalent", cameraMoveCine);
    ModelHelper.createPoster(scene, '../posters/actus1.png', {x: -5.6, y: -2.08, z: -4.41}, 1.59, "posterActus", cameraMoveCine);
    ModelHelper.createPoster(scene, '../posters/contact.png', {x: -5.6, y: -2.08, z: -6.63}, 1.59, "posterContact", cameraMoveContact);

    ModelHelper.createPoster(scene, '../posters/contact.png', {x: 13.2, y: -1.4, z: -5.74}, -1.575, "posterContact", cameraMoveContact, {width: 1.18, height: 3.35});
    ModelHelper.createPoster(scene, '../posters/contactRoom/hakim.png', {x: 13.2, y: -1.96, z: -1.96}, -1.575, "posterContact", cameraMoveContact, {width: 1.18, height: 3.2});
    ModelHelper.createPoster(scene, '../posters/contactRoom/gaetan.png', {x: 13.2, y: -0.04, z: -4.05}, -1.575, "posterContact", cameraMoveContact, {width: 1.18, height: 3.35});
    const poster3 = ModelHelper.createPoster(scene, '../posters/contactRoom/walid.png', {x: 13.2, y: -0.26, z: -2.28}, -1.58, "posterContact", cameraMoveContact, {width: 1.6, height: 2.3});
    const grandPoster = ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: 11.5, y: -1.3, z: -6.9}, 0, "posterContact", cameraMoveContact, {width: 1.93, height: 5.32});
    const grandPosterEntree = ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: 4.8, y: -1.64, z: -7.95}, 0, "posterContact", cameraMoveContact, {width: 1.38, height: 3.8});
    const posterTalent = ModelHelper.createPoster(scene, '../posters/affiche.png', {x: 13.2, y: -1.9, z: -3.78}, -1.58, "posterContact", cameraMoveContact, {width: 1.18, height: 3.35});
    const poster4 = ModelHelper.createPoster(scene, '../posters/affiche.png', {x: 13.2, y: -1.25, z: -0.25}, -1.58, "posterContact", cameraMoveContact, {width: 1.18, height: 3.35});

    // Posters front wall entrance
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: 5.15, y: -2.34, z: 4.45}, 0.1, "posterContact", cameraMoveContact, {width: 1.38, height: 3.8});
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: 9.25, y: -2.33, z: 4.3}, 0, "posterContact", cameraMoveContact, {width: 1.38, height: 3.85});
    const grandPosterEntree2 = ModelHelper.createPoster(scene, '../posters/contactRoom/poster2.jpg', {x: -9.02, y: -2.34, z: 4.2}, 0, "posterContact", cameraMoveContact, {width: 1.38, height: 3.85});
    ModelHelper.createPoster(scene, '../posters/contactRoom/poster1.jpg', {x: -5.14, y: -2.33, z: 4.45}, -0.07, "posterContact", cameraMoveContact, {width: 1.38, height: 3.85});
    
    // poster3.rotation.x = 1.58
    poster4.rotation.x = 1.58
    posterTalent.rotation.x = 1.58;

    // const cubeTestRotation = SceneHelper.gui.addFolder('poster3 ')
    //     cubeTestRotation.add(poster3.position, 'x').min(-60).max(60).step(0.01).name('position X')
    //     cubeTestRotation.add(poster3.position, 'y').min(-60).max(60).step(0.01).name('position Y')
    //     cubeTestRotation.add(poster3.position, 'z').min(-60).max(60).step(0.01).name('position Z')
    //     cubeTestRotation.add(poster3.rotation, 'x').min(-60).max(60).step(0.01).name('rotation X')
    //     cubeTestRotation.add(poster3.rotation, 'y').min(-60).max(60).step(0.01).name('rotation Y')
    //     cubeTestRotation.add(poster3.rotation, 'z').min(-60).max(60).step(0.01).name('rotation Z')

    /**
     * Click function
     */
    window.addEventListener('click', onDocumentMouseDown, false);

    // Return buttons 
    const returnButton1 = ModelHelper.createButton(scene, "../assets/images/menu.png", 0, {x: 0, y: -2.4, z: 26.5}, "enterMenu", cameraMoveReturn, {width: 0.68, height: 2.85});
    ModelHelper.createButton(scene, "../assets/images/menu.png", 0, {x: -2.7, y: -0.5, z: -12.5}, "return", cameraMoveReturn, {width: 0.68, height: 2.85});
    ModelHelper.createButton(scene, "../assets/images/menu.png", -1.5, {x: 11.1, y: -0.07, z: -5.55}, "return1", cameraMoveReturn, {width: 0.68, height: 2.85});

    /**
     * Movie screen (test with local video)
     */
    const video = document.getElementById('video');
    const videoTexture = new THREE.VideoTexture(video);
    const videoMaterial =  new THREE.MeshBasicMaterial( {map: videoTexture, side: THREE.FrontSide, toneMapped: false} );

    const screen = new THREE.PlaneGeometry(10.1, 14.05*0.51);
    const videoScreen = new THREE.Mesh(screen, videoMaterial);
    video.play()

    videoScreen.position.set(0, -2.6, -22)
    videoScreen.name = "movieScreen"

    scene.add(videoScreen);

    // GUI panel 
    // const planeTest = SceneHelper.gui.addFolder('camera');
    // planeTest.add(camera.position, 'x').min(-60).max(60).step(0.01).name('position X');
    // planeTest.add(camera.position, 'y').min(-60).max(60).step(0.01).name('position Y');
    // planeTest.add(camera.position, 'z').min(-60).max(60).step(0.01).name('position Z');

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

        // const textPos = SceneHelper.gui.addFolder('return (position)')
        // textPos.add(returnButton1.position, 'x').min(-60).max(60).step(0.01).name('position X')
        // textPos.add(returnButton1.position, 'y').min(-60).max(60).step(0.01).name('position Y')
        // textPos.add(returnButton1.position, 'z').min(-60).max(60).step(0.01).name('position Z')

        // const cubeTestRotation = SceneHelper.gui.addFolder('return (rotation)')
        // cubeTestRotation.add(returnButton1.rotation, 'x').min(-60).max(60).step(0.01).name('position X')
        // cubeTestRotation.add(returnButton1.rotation, 'y').min(-60).max(60).step(0.01).name('position Y')
        // cubeTestRotation.add(returnButton1.rotation, 'z').min(-60).max(60).step(0.01).name('position Z')
    });

    /**
     * Controls
     */
    const controls = SceneHelper.createControls(canvas);

    /**
     * Renderer
     */
    const renderer = SceneHelper.createRenderer(canvas, sizes);
    
    setupNavigation(scene, renderer, camera, controls);

    /**
     * Animate
     */
    const clock = new THREE.Clock();

    const tick = () =>
    {
        const elapsedTime = clock.getElapsedTime();

        // Update controls
        controls.update();

        // Render
        renderer.render(scene, camera);

        // Call tick again on the next frame
        window.requestAnimationFrame(tick);
    };

    tick();
});

</script>
<style>

    .webgl{
        position: fixed;
        top: 0;
        left: 0;
        outline: none; 
    }
</style>
<!-- <button bind:this={button1} style="position:relative;" id="button1" class="camera-button" >Position 1</button> -->
<!-- <button bind:this={cameraMove} style="position:relative;">Camera</button> -->
<video id="video" playsinline webkit-playsinline muted loop autoplay width="2000" height="500"src="../posters/testFilm/test.mov" style="display: none;"></video>
<canvas bind:this={canvas} class="webgl"></canvas>


