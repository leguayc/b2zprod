<script>
import * as dat from 'lil-gui';
import * as THREE from 'three';
import { onMount } from 'svelte';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';
import { TWEEN } from 'three/examples/jsm/libs/tween.module.min';
import { gsap } from "gsap";

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


    // button1.addEventListener('click', function(ev) {
    //   var buttonId = ev.target.id;
    //   var cameraSettings = buttonCameraSettings[buttonId];
    // //   updateCameraTweens(cameraSettings);
    // });

    cameraMove.addEventListener('click', function() {
        console.log("click camera")
        gsap.to(camera.position, {z: -1.8, duration: 10});
        gsap.to(camera.position, {x: 1.2, duration: 10});
        gsap.to(camera.position, {y: -1.5, duration: 2});
        controls.target.set( -12, -2, -2);
        camera.rotation.z = 10
    });

    // GUI tests
    gui.add(cube.position, 'x').min(-60).max(60).step(0.01).name('cube X')
    gui.add(cube.position, 'y').min(-60).max(60).step(0.01).name('cube Y')
    gui.add(cube.position, 'z').min(-60).max(60).step(0.01).name('cube Z')
    gui.add(camera.position, 'x').min(-60).max(60).step(0.01).name('Camera X')
    gui.add(camera.position, 'y').min(-60).max(60).step(0.01).name('Camera Y')
    gui.add(camera.position, 'z').min(-60).max(60).step(0.01).name('Camera Z')

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
<button bind:this={cameraMove} style="position:relative;">Camera</button>
<canvas bind:this={canvas} class="webgl"></canvas>


