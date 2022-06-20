import * as dat from 'lil-gui';
import * as THREE from 'three';
import { FontLoader } from 'three/examples/jsm/loaders/FontLoader.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

export const gui = new dat.GUI({
    width: 400
});

export const fontLoader = new FontLoader();

// Texture loader
export const textureLoader = new THREE.TextureLoader();
export const loaderPoster = new THREE.TextureLoader();

// Draco loader
export const dracoLoader = new DRACOLoader();
dracoLoader.setDecoderPath('draco/');

// GLTF loader
export const gltfLoader = new GLTFLoader();
gltfLoader.setDRACOLoader(dracoLoader);

let sizes = {};
export let renderer;
export let camera;

export function createSceneBase() {
    // Scene
    const scene = new THREE.Scene();
    scene.background = new THREE.Color( "#fff" );

    createBaseModel(scene);

    return scene;
}

export function createBaseModel(scene)
{
    /**
     * textures
     */
    const bakedTexture = textureLoader.load('../static/bakedFinal.jpg');
    bakedTexture.flipY = false;

    /**
     * Materials
     */
    // Baked material 
    const bakedMaterial = new THREE.MeshBasicMaterial({ map: bakedTexture });

    /**
     * Model
     */
    gltfLoader.load(
        '../static/cinemaFinal.glb', 
        (gltf) => {
            gltf.scene.traverse((child) => {
                child.material = bakedMaterial
            });
            gltf.scene.position.y = -4;
            scene.add(gltf.scene);
        }
    );
}

export function addLights(scene)
{
    const light = new THREE.AmbientLight( 0x404040, 4 );
    scene.add(light);

    return light;
}

export function setResize()
{
    sizes = {
        width: window.innerWidth,
        height: window.innerHeight
    };

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
    });

    return sizes;
}

export function addCamera(scene)
{
    // Base camera
    camera = new THREE.PerspectiveCamera(45, sizes.width / sizes.height, 0.1, 100);
    camera.position.set(0, -2, 30);
    scene.add(camera);

    return camera;
}

export function createRenderer(canvas, sizes)
{
    renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true
    });

    renderer.setSize(sizes.width, sizes.height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    return renderer;
}

export function createControls(canvas)
{
    const controls = new OrbitControls(camera, canvas);
    // controls.enableDamping = true
    // controls.dampingFactor = 0.05
    // controls.screenSpacePanning = false
    // controls.minDistance = 2
    // controls.maxDistance = 30
    // controls.maxPolarAngle = (Math.PI / 2) - 0.1;

    return controls;
}