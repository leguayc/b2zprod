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
    scene.background = new THREE.Color( "#03224c" );

    scene.fog = new THREE.FogExp2( '#03224c' , 0.02 ); 

    // Floor 
    const geometryFloor = new THREE.PlaneGeometry( 55, 35 );
    const materialFloor = new THREE.MeshBasicMaterial( {color: 0x323739, side: THREE.DoubleSide} );
    const floor = new THREE.Mesh( geometryFloor, materialFloor );
    scene.add( floor );
    floor.position.set(0.71, -4.3, 9.31)
    floor.rotation.x = -1.57

    /**
     * Stars
     */
    const objectsDistance = 4
    const particlesCount = 700
    const positions = new Float32Array(particlesCount * 3 )

    for( let i = 0; i < particlesCount; i++){
        positions[i * 3 + 0 ] = (Math.random() - 0.5) * 60
        positions[i * 3 + 1 ] = objectsDistance * 0.5 - Math.random() * objectsDistance * 30
        positions[i * 3 + 2 ] = (Math.random() - 0.5) * 40
    }

    function createCircleTexture(color, size) {
        var matCanvas = document.createElement('canvas');
        matCanvas.width = matCanvas.height = size;
        var matContext = matCanvas.getContext('2d');
        // create texture object from canvas.
        var texture = new THREE.Texture(matCanvas);
        // Draw a circle
        var center = size / 2;
        matContext.beginPath();
        matContext.arc(center, center, size/2, 0, 2 * Math.PI, false);
        matContext.closePath();
        matContext.fillStyle = color;
        matContext.fill();
        // need to set needsUpdate
        texture.needsUpdate = true;
        // return a texture made from the canvas
        return texture;
    }

    const particlesGeometry = new THREE.BufferGeometry()
    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3))

    const particlesMaterial = new THREE.PointsMaterial({
        // color: parameters.materialColor, 
        // color: 0x000000,
        sizeAttenuation: true, 
        // size: 0.04
        map: createCircleTexture('#ffffff', 256),
        size: 0.08,
        transparent: true,
        depthWrite: false
    })

    // Points
    const particles = new THREE.Points(particlesGeometry, particlesMaterial)

    particles.position.set(0, 35, -2)
    scene.add(particles)

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