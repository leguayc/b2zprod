<script>
import * as dat from 'lil-gui';
import * as THREE from 'three';
import { onMount } from 'svelte';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';
import { TWEEN } from 'three/examples/jsm/libs/tween.module.min';
// import { gsap } from "gsap";

// Canvas
let canvas;
let button1;

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
    const bakedTexture = textureLoader.load('baked.jpg')
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
        'cinema.glb', 
        (gltf) => {
            gltf.scene.traverse((child) => {
                child.material = bakedMaterial
            })
            console.log(gltf.scene)
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
    camera.position.x = 0
    camera.position.y = 3.2
    camera.position.z = 60
    scene.add(camera)






    // test deplacement camera - button 

    var camPos = new THREE.Vector3(0, 0, 0);       // Holds current camera position
    var targetPos = new THREE.Vector3(10, 10, -10);// Target position
    var origin = new THREE.Vector3(0, 0, 0);       // Optional origin

    function animate(){
        // Interpolate camPos toward targetPos
        camPos.lerp(targetPos, 0.05);

        // USE GSAP

        // Apply new camPos to your camera
        camera.position.copy(camPos);

        // (Optional) have camera look at the origin after it's been moved
        camera.lookAt(origin);

        // render();
    }

    // test 2

    var buttonCameraSettings = {
        button1: {
        position: {x: 10, y: 0, z: 0},
        rotation: {x: 0, y: Math.PI, z: 0}
        }
    };

    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( {color: 0x00ff00} );
    const cube = new THREE.Mesh( geometry, material );
    scene.add( cube );

    button1.addEventListener('click', function(ev) {
      var buttonId = ev.target.id;
      var cameraSettings = buttonCameraSettings[buttonId];

      animate()

    //   updateCameraTweens(cameraSettings);
    });

    function updateCameraTweens(params) {
      if (params.position) {
        positionTween.stop();
        positionTween.to(params.position, 1000).start();
      }

      if (params.rotation) {
        rotationTween.stop();
        rotationTween.to(params.rotation, 1000).start();
      }
    }

    var quatTween = new TWEEN.Tween(camera.quaternion);
    var toQuaternion = new THREE.Quaternion();
    var toEuler = new THREE.Euler();

    // in updateCameraTweens()
    // toEuler.set(rotation.x, rotation.y, rotation.z);
    // toQuaternion.setFromEuler(toEuler);
    // quatTween.to(toQuaternion, 1000).start();


    // fin test 







    // Controls
    console.log(canvas)
    const controls = new OrbitControls(camera, canvas)

    controls.enableDamping = true
    controls.dampingFactor = 0.05
    controls.screenSpacePanning = false
    controls.minDistance = 2
    controls.maxDistance = 30

    controls.maxPolarAngle = (Math.PI / 2) - 0.1;

    gui.add(camera.position, 'x').min(-20).max(60).step(0.01).name('Camera X')
    gui.add(camera.position, 'y').min(-20).max(60).step(0.01).name('Camera Y')
    gui.add(camera.position, 'z').min(-20).max(60).step(0.01).name('Camera Z')

    console.log(canvas)

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

    const tick = () =>
    {
        const elapsedTime = clock.getElapsedTime()

        // THREE.MathUtils.lerp(scene.rotation.x, Math.cos(t / 2) / 15 + 0.25 + rotationOffset[0], 0.1);
        // camera.position.x = THREE.MathUtils.lerp(camera.position.x, 30, 0.1);


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


<canvas bind:this={canvas} class="webgl"></canvas>
<button bind:this={button1} style="position:relative" id="button1" class="camera-button" >Position 1</button>

