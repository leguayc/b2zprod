<script>
import * as dat from 'lil-gui';
import * as THREE from 'three';
import { onMount } from 'svelte';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';
import { TWEEN } from 'three/examples/jsm/libs/tween.module.min';
import { gsap } from "gsap";
import {filmAffiche} from "../helpers/Poster"

// Canvas
let canvas;
let button1;
let cameraMove;

onMount(() => {
    /**
     * Base
     */
    // Debug
    const gui = new dat.GUI({
        width: 400
    });

    // Scene
    const scene = new THREE.Scene()
    scene.background = new THREE.Color( "#fff" );
    /**
     * Loaders
     */
    // Texture loader
    const textureLoader = new THREE.TextureLoader()

    // Draco loader
    const dracoLoader = new DRACOLoader()
    dracoLoader.setDecoderPath('draco/')

    // GLTF loader
    const gltfLoader = new GLTFLoader()
    gltfLoader.setDRACOLoader(dracoLoader)

    /**
     * textures
     */
    const bakedTexture = textureLoader.load('../static/baked.jpg')
    bakedTexture.flipY = false

    /**
     * Materials
     */
    // Baked material 
    const bakedMaterial = new THREE.MeshBasicMaterial({ map: bakedTexture })

    /**
     * Model
     */
    gltfLoader.load(
        '../static/cinema.glb', 
        (gltf) => {
            gltf.scene.traverse((child) => {
                child.material = bakedMaterial
            })
            console.log(gltf.scene)
            gltf.scene.position.y = -4
            scene.add(gltf.scene)
        }
    )

    /**
     * Lights
     */
    const light = new THREE.AmbientLight( 0x404040, 4 );
    scene.add( light );

    /**
     * Sizes
     */
    const sizes = {
        width: window.innerWidth,
        height: window.innerHeight
    }

    window.addEventListener('resize', () =>
    {
        // Update sizes
        sizes.width = window.innerWidth
        sizes.height = window.innerHeight

        // Update camera
        camera.aspect = sizes.width / sizes.height
        camera.updateProjectionMatrix()

        // Update renderer
        renderer.setSize(sizes.width, sizes.height)
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
    })

    /**
     * Camera
     */
    // Base camera
    const camera = new THREE.PerspectiveCamera(45, sizes.width / sizes.height, 0.1, 100)
    camera.position.set(0, -2, 30)
    scene.add(camera)

    // Cube for test possition
    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( {color: 0x00ff00} );
    const cube = new THREE.Mesh( geometry, material );

    cube.position.x = -16
    cube.position.y = -2
    cube.position.z = -2

    scene.add( cube );

    function cameraMove(){
        gsap.to(camera.position, {z: -1.8, duration: 10});
        gsap.to(camera.position, {x: 1.2, duration: 10});
        gsap.to(camera.position, {y: -1.5, duration: 2});
        controls.target.set( -12, -2, -2);
        camera.rotation.z = 10
    }

    // Welcome button 
    const raycaster = new THREE.Raycaster()


    const geometryPlane = new THREE.PlaneGeometry( 1, 1 );
    const materialPlane = new THREE.MeshBasicMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
    const plane = new THREE.Mesh( geometryPlane, materialPlane );
    plane.position.set(0, -2.4, 26.5)
    plane.name = "plane";
    scene.add( plane );

    window.addEventListener('click', onDocumentMouseDown, false);

    var mouse = new THREE.Vector2();
    function onDocumentMouseDown( event ) {
        mouse.x = ( event.clientX / renderer.domElement.clientWidth ) * 2 - 1;
        mouse.y = - ( event.clientY / renderer.domElement.clientHeight ) * 2 + 1;
        raycaster.setFromCamera( mouse, camera );
        var intersects = raycaster.intersectObjects( scene.children );
        
        if ( intersects.length > 0 ) {
            console.log(intersects[0].object.name)
            intersects[0].object.callback();
        }
    }

    plane.callback = function() { cameraMove();}
    // circle2.callback = function() { changeByPortal();}

    // function changeByPortal(){
    //     var selectedObject = scene.getObjectByName("cercle"); 
    //     const darkmode =  new Darkmode();
    //     darkmode.toggle();
    // }


    // GUI tests
    const cubeTest = gui.addFolder('Cube')
    cubeTest.add(cube.position, 'x').min(-60).max(60).step(0.01).name('position X')
    cubeTest.add(cube.position, 'y').min(-60).max(60).step(0.01).name('position Y')
    cubeTest.add(cube.position, 'z').min(-60).max(60).step(0.01).name('position Z')

    const planeTest = gui.addFolder('Plane')
    planeTest.add(plane.position, 'x').min(-60).max(60).step(0.01).name('position X')
    planeTest.add(plane.position, 'y').min(-60).max(60).step(0.01).name('position Y')
    planeTest.add(plane.position, 'z').min(-60).max(60).step(0.01).name('position Z')

    /**
     * Poster first room 
     */
    //Film a l'affiche
    var loaderPoster = new THREE.TextureLoader();
    var materialPosterAffiche = new THREE.MeshLambertMaterial({
    // map: loaderPoster.load('https://paulmarechal.xyz/b2z/affiche.png')
        map: loaderPoster.load('../posters/affiche.png')
    });
    // Plane geometry for the image and preserve the image aspect ratio 
    var geometryPosterAffiche = new THREE.PlaneGeometry(1.38, 3.8*0.51);
    // Combine image geometry and material 
    var posterAffiche = new THREE.Mesh(geometryPosterAffiche, materialPosterAffiche);

    posterAffiche.position.set(-5.65, -2.1, 2.41)
    posterAffiche.rotation.y = 1.59
    posterAffiche.name = "posterAffiche"
    scene.add(posterAffiche)

    // Salle Infos 
    var materialPosterInfos = new THREE.MeshLambertMaterial({
    map: loaderPoster.load('../posters/infos.png')
    });
    var geometryPosterInfos = new THREE.PlaneGeometry(1.38, 3.8*0.51);
    var posterInfos = new THREE.Mesh(geometryPosterInfos, materialPosterInfos);

    posterInfos.position.set(-5.65, -2.1, 0.09)
    posterInfos.rotation.y = 1.59
    posterInfos.name = "posterInfos"
    scene.add(posterInfos)

    // // Salle talent
    var materialPosterTalent = new THREE.MeshLambertMaterial({
    map: loaderPoster.load('../posters/talents.png')
    });
    var geometryPosterTalent = new THREE.PlaneGeometry(1.38, 3.8*0.51);
    var posterTalent = new THREE.Mesh(geometryPosterTalent, materialPosterTalent);

    posterTalent.position.set(-5.65, -2.1, -2.17)
    posterTalent.rotation.y = 1.59
    posterTalent.name = "posterTalent"
    scene.add(posterTalent)

    // Salle actus
    var materialPosterActus = new THREE.MeshLambertMaterial({
    map: loaderPoster.load('../posters/actus1.png')
    });
    var geometryPosterActus = new THREE.PlaneGeometry(1.38, 3.8*0.51);
    var posterActus = new THREE.Mesh(geometryPosterActus, materialPosterActus);

    posterActus.position.set(-5.65, -2.1, -4.43)
    posterActus.rotation.y = 1.59
    posterActus.name = "posterActus"
    scene.add(posterActus)

    // Salle contact
    loaderPoster.load('../posters/contact.png', (texture) => {
        
        console.log(texture);
        var materialPosterContact = new THREE.MeshLambertMaterial({
            map: texture
        }); 
        var geometryPosterContact = new THREE.PlaneGeometry(1.38, 3.8*0.51);
        var posterContact = new THREE.Mesh(geometryPosterContact, materialPosterContact);

        posterContact.position.set(-5.65, -2.1, -6.63)
        posterContact.rotation.y = 1.59
        posterContact.name = "posterContact"
        scene.add(posterContact);
    });

    // const poster1 = gui.addFolder('Poster')
    // poster1.add(posterActus.position, 'x').min(-60).max(60).step(0.01).name('position X')
    // poster1.add(posterActus.position, 'y').min(-60).max(60).step(0.01).name('position Y')
    // poster1.add(posterActus.position, 'z').min(-60).max(60).step(0.01).name('position Z')

    // poster1.add(posterContact.position, 'x').min(-60).max(60).step(0.01).name('position X')
    // poster1.add(posterContact.position, 'y').min(-60).max(60).step(0.01).name('position Y')
    // poster1.add(posterContact.position, 'z').min(-60).max(60).step(0.01).name('position Z')

    // Controls
    console.log(canvas)
    const controls = new OrbitControls(camera, canvas)
    // controls.enableDamping = true
    // controls.dampingFactor = 0.05
    // controls.screenSpacePanning = false
    // controls.minDistance = 2
    // controls.maxDistance = 30
    // controls.maxPolarAngle = (Math.PI / 2) - 0.1;

    /**
     * Renderer
     */
    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true
    })
    renderer.setSize(sizes.width, sizes.height)
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

    /**
     * Animate
     */
    const clock = new THREE.Clock()

    let t

    const tick = () =>
    {
        const elapsedTime = clock.getElapsedTime()

        // button1 = THREE.MathUtils.lerp(camera.position.x, 30, 0.1);

        // Update controls
        controls.update()

        // Render
        renderer.render(scene, camera)

        // Call tick again on the next frame
        window.requestAnimationFrame(tick)
    }

    tick()
});

</script>

<!-- <button bind:this={button1} style="position:relative;" id="button1" class="camera-button" >Position 1</button> -->
<!-- <button bind:this={cameraMove} style="position:relative;">Camera</button> -->
<canvas bind:this={canvas} class="webgl"></canvas>


